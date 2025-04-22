<?php
/**
 * Attributes contract.
 *
 * Defines the contract that classes for building HTML attributes must adhere to.
 * Extends the `Renderable` and `Displayable` contracts for handling output.
 * Attributes are meant to be used for HTML elements.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/backdrop-dev/attr
 */

namespace Backdrop\Attr\Contracts;

use Backdrop\Contracts\Displayable;
use Backdrop\Contracts\Renderable;

/**
 * Attributes interface.
 *
 * @since  1.0.0
 *
 * @access public
 */
interface Attributes extends Renderable, Displayable {

    /**
     * Returns an array of HTML attributes in name/value pairs. Attributes
     * are not expected to be escaped. Escaping should be handled on output.
     *
     * @since  1.0.0
     * @return array
     *
     * @access public
     */
    public function all();

    /**
     * Returns a single, unescaped attribute's value.
     *
     * @since  1.0.0
     * @param  string $name
     * @return string
     *
     * @access public
     */
    public function get( $name );

    /**
     * Adds custom data to the attribute object.
     *
     * @since  1.0.0
     * @param  string|array $name
     * @param  mixed        $value
     * @return $this
     *
     * @access public
     */
    public function with( $key, $value = null );

}