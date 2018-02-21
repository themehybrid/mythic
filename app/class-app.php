<?php

namespace ABC;

class App {

	public $dir = '';

	public $uri = '';

	public $namespace = '';

	public $container = '';

	public $config = [];

	public function __construct( array $args = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

			if ( isset( $args[ $key ] ) )
				$this->$key = $args[ $key ];
		}
	}
}
