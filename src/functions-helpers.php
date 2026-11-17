<?php
/**
 * Attribute functions.
 *
 * HTML attribute functions and filters.  The purposes of this is to provide a
 * way for theme/plugin devs to hook into the attributes for specific HTML
 * elements and create new or modify existing attributes. This is sort of like
 * `body_class()`, `post_class()`, and `comment_class()` on steroids.  Plus, it
 * handles attributes for many more elements.  The biggest benefit of using this
 * is to provide richer microdata while being forward compatible with the
 * ever-changing Web.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/backdrop-dev/attr
 */

namespace Backdrop\Attr;

use Backdrop\Proxies\App;
use Backdrop\Attr\Contracts\Attributes;

if ( ! function_exists( __NAMESPACE__ . '\\attr' ) ) {
    /**
     * Wrapper for creating a new `Attributes` object.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  string $context
     * @param  array  $attr
     * @return \Backdrop\Attr\Contracts\Attributes
     *
     * @access public
     */
    function attr( string $name, string $context = '', array $attr = [] ): Attributes {
        return App::resolve(
            Attributes::class,
            compact( 'name', 'context', 'attr' )
        );
    }
}

if ( ! function_exists( __NAMESPACE__ . '\\display' ) ) {
    /**
     * Outputs an HTML element's attributes.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  string $context
     * @param  array  $attr
     * @return void
     *
     * @access public
     */
    function display( string $name, string $context = '', array $attr = [] ): void {
        attr( $name, $context, $attr )->display();
    }
}

if ( ! function_exists( __NAMESPACE__ . '\\render' ) ) {
    /**
     * Returns an HTML element's attributes.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  string $context
     * @param  array  $attr
     * @return string
     *
     * @access public
     */
    function render( string $name, string $context = '', array $attr = [] ): string {
        return attr( $name, $context, $attr )->render();
    }
}