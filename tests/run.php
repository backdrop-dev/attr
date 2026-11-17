<?php
/**
 * Dependency free tests. Run with: php tests/run.php
 */

require __DIR__ . '/bootstrap.php';

use Backdrop\Attr\Attr;

$failed = 0;

function check( string $label, $actual, $expected ): void {
    global $failed;
    if ( $actual === $expected ) {
        echo "ok   - {$label}\n";
        return;
    }
    $failed++;
    echo "FAIL - {$label}\n       expected: " . var_export( $expected, true ) . "\n       actual:   " . var_export( $actual, true ) . "\n";
}

// Default class and context.
check( 'default class', ( new Attr( 'foo' ) )->render(), 'class="foo"' );
check( 'default class with context', ( new Attr( 'sidebar', 'primary' ) )->render(), 'class="sidebar sidebar--primary"' );

// Input wins over defaults and a custom class is kept.
check( 'custom class and attribute', ( new Attr( 'foo', '', [ 'class' => 'bar', 'id' => 'x' ] ) )->render(), 'class="bar" id="x"' );

// Escaping.
check( 'value is escaped', ( new Attr( 'a', '', [ 'class' => 'a', 'title' => '"q"' ] ) )->render(), 'class="a" title="&quot;q&quot;"' );
check( 'href uses esc_url', ( new Attr( 'a', '', [ 'class' => 'a', 'href' => 'http://x.test/?a=1&b=2' ] ) )->render(), 'class="a" href="http://x.test/?a=1&#038;b=2"' );

// true is a bare attribute; false and null are omitted.
check( 'true is bare', ( new Attr( 'a', '', [ 'class' => 'a', 'hidden' => true ] ) )->render(), 'class="a" hidden' );
check( 'false is omitted', ( new Attr( 'a', '', [ 'class' => 'a', 'hidden' => false ] ) )->render(), 'class="a"' );
check( 'null is omitted', ( new Attr( 'a', '', [ 'class' => 'a', 'hidden' => null ] ) )->render(), 'class="a"' );

// Element names that match class methods must not call them.
foreach ( [ 'render', 'display', 'all', 'get', 'with', '__toString' ] as $name ) {
    check( "name '{$name}' is a plain element", ( new Attr( $name ) )->render(), "class=\"{$name}\"" );
}

// get() and string casting.
check( 'get class', ( new Attr( 'foo', 'ctx' ) )->get( 'class' ), 'foo foo--ctx' );
check( 'get missing', ( new Attr( 'foo' ) )->get( 'nope' ), '' );
check( 'string cast', (string) new Attr( 'foo' ), 'class="foo"' );

// display() echoes.
ob_start();
( new Attr( 'foo' ) )->display();
check( 'display echoes', ob_get_clean(), 'class="foo"' );

// Filters.
add_filter( 'backdrop/attr/menu/defaults', function ( $d ) { $d['role'] = 'navigation'; return $d; } );
add_filter( 'backdrop/attr/menu', function ( $a, $ctx ) { $a['data-ctx'] = $ctx; return $a; } );
add_filter( 'backdrop/attr/menu/class', function ( $c ) { $c[] = 'extra'; $c[] = 'extra'; return $c; } );
check( 'filters', ( new Attr( 'menu', 'main' ) )->render(), 'class="menu menu--main extra" role="navigation" data-ctx="main"' );

// with() after the attributes were built rebuilds them.
add_filter( 'backdrop/attr/thing', function ( $a ) { return $a; } );
$attr = new Attr( 'thing' );
$attr->all();
add_filter( 'backdrop/attr/thing/defaults', function ( $d, $ctx, $obj ) { $d['data-n'] = 'set'; return $d; } );
$attr->with( 'n', 1 );
check( 'with() resets built attributes', $attr->get( 'data-n' ), 'set' );

echo $failed ? "\n{$failed} test(s) failed\n" : "\nAll tests passed\n";
exit( $failed ? 1 : 0 );
