<?php
/**
 * Registry class.
 *
 * This file houses the `Registry` class, which is a class used for storing
 * collections of data.  Generally speaking, it was built for storing an
 * array of key/value pairs.  Values can be any type of value.  Keys should
 * be named rather than numeric if you need easy access.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

/**
 * Registry class.
 *
 * @since  1.0.0
 * @access public
 */
class Collection implements \ArrayAccess {

	/**
	 * Array of items in the collection.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $items = [];

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $items
	 * @return void
	 */
	public function __construct( $items = [] ) {

		$this->items = $items;
	}

	/**
	 * Register an item.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function add( $name, $value ) {

		if ( ! $this->has( $name ) )
			$this->items[ $name ] = $value;
	}

	/**
	 * Unadds an item.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function remove( $name ) {

		if ( $this->has( $name ) )
			unset( $this->items[ $name ] );
	}

	/**
	 * Checks if an item has.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function has( $name ) {

		return isset( $this->items[ $name ] );
	}

	/**
	 * Returns an item.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function get( $name ) {

		return $this->has( $name ) ? $this->items[ $name ] : false;
	}

	/**
	 * Returns the entire collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_items() {

		return $this->items;
	}

	/**
	 * Magic method when trying to set a property. Assume the property
	 * is part of the collection and add it.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set( $name, $value ) {

		$this->add( $name, $value );
	}

	/**
	 * Magic method when trying to unset a property.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function __unset( $name ) {

		$this->remove( $name );
	}

	/**
	 * Magic method when trying to check if a property has.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function __isset( $name ) {

		return $this->has( $name );
	}

	/**
	 * Magic method when trying to get a property.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function __get( $name ) {

		return $this->get( $name );
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
	 * Checks if a property has via `ArrayAccess`.
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
