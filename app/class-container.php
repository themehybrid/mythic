<?php

namespace ABC;

class Container {

	protected $definitions = [];

	public function add( $alias, $concrete = null ) {

		$this->definitions[ $alias ] = is_null( $concrete ) ? $alias : $concrete;
	}

	public function remove( $alias ) {

		if ( $this->has( $alias ) )
			unset( $this->definitions[ $alias ] );
	}

	public function get( $alias ) {

		return $this->has( $alias ) ? $this->definitions[ $alias ] : false;
	}

	public function has( $alias ) {

		return isset( $this->definitions[ $alias ] );
	}
}
