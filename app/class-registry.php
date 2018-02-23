<?php

namespace ABC;

/**
 * Registry class.
 *
 * @since  1.0.0
 * @access public
 */
class Registry implements \ArrayAccess {

	/**
	 * Array of items in the collection.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $collection = [];

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $collection
	 * @return void
	 */
	public function __construct( $collection = [] ) {

		$this->collection = $collection;
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
	public function register( $name, $value ) {

		if ( ! $this->exists( $name ) )
			$this->collection[ $name ] = $value;
	}

	/**
	 * Unregisters an item.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function unregister( $name ) {

		if ( $this->exists( $name ) )
			unset( $this->collection[ $name ] );
	}

	/**
	 * Checks if an item exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function exists( $name ) {

		return isset( $this->collection[ $name ] );
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

		return $this->exists( $name ) ? $this->collection[ $name ] : false;
	}

	/**
	 * Returns the entire collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_collection() {

		return $this->collection;
	}

	/**
	 * Magic method when trying to set a property. Assume the property
	 * is part of the collection and register it.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set( $name, $value ) {
		$this->register( $name, $value );
	}

	public function __unset( $name ) {
		$this->unregister( $name );
	}

	public function __isset( $name ) {
		return $this->exists( $name );
	}

	public function __get( $name ) {
		return $this->get( $name );
	}

	public function offsetSet( $name, $value ) {
		$this->register( $name, $value );
	}

	public function offsetUnset( $name ) {
		$this->unregister( $name );
	}

	public function offsetExists( $name ) {
		return $this->exists( $name );
	}

	public function offsetGet( $name ) {
		return $this->get( $name );
	}
}
