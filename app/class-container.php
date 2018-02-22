<?php

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
	public function add( $alias, $concrete = null ) {

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
