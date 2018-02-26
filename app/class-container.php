<?php
/**
 * Container class.
 *
 * This file maintains the `Container` class, which handles storing
 * objects for later use.  It's primarily designed for handling
 * single instances to avoid globals or singletons.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

use ArrayAccess;
use SplObjectStorage;
use Psr\Container\ContainerInterface;

/**
 * A simple container for objects.
 *
 * @since  1.0.0
 * @access public
 */
class Container implements ContainerInterface, ArrayAccess {

	/**
	 * Stored instances of objects.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $definitions = [];

	/**
	 * Array of single instance objects.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $instances = [];

	/**
	 * Set to an instance of `SplObjectStorage`.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    object
	 */
	protected $factories;

	public function __construct( array $definitions = [] ) {

		$this->factories = new SplObjectStorage();

		foreach ( $definitions as $alias => $value ) {

			$this->add( $alias, $value );
		}
	}

	/**
	 * Add an object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $alias
	 * @param  object  $concrete
	 * @return void
	 */
	public function add( $alias, $value = null ) {

		if ( isset( $this->instances[ $alias ] ) ) {
			return;
		}

		$this->definitions[ $alias ] = $value;
	}

	/**
	 * Remove an object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $alias
	 * @return void
	 */
	public function remove( $alias ) {

		if ( $this->has( $alias ) ) {

			unset( $this->definitions[ $alias ], $this->instances[ $alias ] );
		}
	}

	/**
	 * Return an object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $alias
	 * @return object
	 */
	public function get( $alias ) {

		if ( ! $this->has( $alias ) ) {
			return false;
		}

		$definition = $this->definitions[ $alias ];

		// If this is not a closure, return the definition.
		if ( ! is_object( $definition ) || ! method_exists( $definition, '__invoke' ) ) {

			return $definition;
		}

		// If we already have a single instance return it.
		if ( isset( $this->instances[ $alias ] ) ) {

			return $this->instances[ $alias ];
		}

		// If this is a factory, call it.
		if ( isset( $this->factories[ $definition ] ) ) {

			return $definition( $this );
		}

		// Store the single instance of the object.
		$this->instances[ $alias ] = $definition( $this );

		// Return the single instance.
		return $this->instances[ $alias ];
	}

	/**
	 * Check if an object exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $alias
	 * @return bool
	 */
	public function has( $alias ) {

		return isset( $this->definitions[ $alias ] );
	}

	/**
	 * Adds a factory and returns the callable object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  callable  $callable
	 * @return callable
	 */
	public function factory( $callable ) {

		$this->factories->attach( $callabale );

		return $callable;
	}

	/**
	 * Sets a property via `ArrayAccess`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function offsetSet( $name, $value ) {

		$this->add( $name, $value );
	}

	/**
	 * Unsets a property via `ArrayAccess`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function offsetUnset( $name ) {

		$this->remove( $name );
	}

	/**
	 * Checks if a property exists via `ArrayAccess`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function offsetExists( $name ) {

		return $this->has( $name );
	}

	/**
	 * Returns a property via `ArrayAccess`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function offsetGet( $name ) {

		return $this->get( $name );
	}
}
