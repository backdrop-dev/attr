<?php
/**
 * Minimal stand-ins for the WordPress/ClassicPress functions that the attr
 * package uses, so the tests run without a WordPress install.
 */

namespace Backdrop\Contracts {
    interface Displayable { public function display(): void; }
    interface Renderable  { public function render(): string; }
}

namespace {
    $GLOBALS['filters'] = [];

    function esc_html( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
    function esc_attr( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
    function esc_url( $s )  { return str_replace( '&', '&#038;', (string) $s ); }
    function wp_parse_args( $args, $defaults = [] ) { return array_merge( $defaults, (array) $args ); }
    function has_filter( $hook ) { return ! empty( $GLOBALS['filters'][ $hook ] ); }
    function add_filter( $hook, $cb ) { $GLOBALS['filters'][ $hook ][] = $cb; }
    function apply_filters( $hook, $value, ...$args ) {
        foreach ( $GLOBALS['filters'][ $hook ] ?? [] as $cb ) {
            $value = $cb( $value, ...$args );
        }
        return $value;
    }

    spl_autoload_register( function ( $class ) {
        if ( 0 === strpos( $class, 'Backdrop\\Attr\\' ) ) {
            $file = __DIR__ . '/../src/' . str_replace( '\\', '/', substr( $class, 14 ) ) . '.php';
            if ( is_file( $file ) ) {
                require $file;
            }
        }
    } );
}
