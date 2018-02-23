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

/**
 * A simple container for objects.
 *
 * @since  1.0.0
 * @access public
 */
class Container {

	/**
	 * Stored instances of objects.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $definitions = [];

	/**
	 * Add an object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $alias
	 * @param  object  $concrete
	 * @return void
	 */
	public function add( $alias, $concrete = null, $share = false ) {

		$this->definitions[ $alias ] = is_null( $concrete ) ? $alias : $concrete;
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

		if ( $this->has( $alias ) )
			unset( $this->definitions[ $alias ] );
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

		return $this->has( $alias ) ? $this->definitions[ $alias ] : false;
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
}
