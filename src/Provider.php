<?php
/**
 * Attributes service provider.
 *
 * This is the service provider for the attributes system. The primary purpose
 * of this is to use the container as a factory for creating attributes. By
 * adding this to the container, it also allows the implementation to be
 * overwritten. That way, any custom functions will utilize the new class.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/backdrop-dev/attr
 */

namespace Backdrop\Attr;

use Backdrop\Attr\Contracts\Attributes;
use Backdrop\Core\ServiceProvider;

/**
 * Attr provider class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds the implementation of the attributes contract to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {
        $this->app->bind( Attributes::class, Attr::class );
    }

}