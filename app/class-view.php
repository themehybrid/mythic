<?php

namespace ABC;

class View {

	protected $name = '';
	protected $slugs = [];
	protected $data = [];
	protected $template = '';

	public function __construct( $name, $slugs = [], $data = [] ) {

		$this->name  = $name;
		$this->slugs = (array) apply_filters( app()->namespace . "/view_slugs_{$this->name}", $slugs );
		$this->data  = (array) apply_filters( app()->namespace . "/view_data_{$this->name}",  $data  );
	}

	protected function locate() {

		$this->template = locate_template( $this->get_hierarchy(), false, false );
	}

	protected function get_hierarchy() {

		foreach ( $this->slugs as $slug ) {

			$templates[] = "resources/views/{$this->name}/{$slug}.php";
		}

		if ( ! in_array( 'default', $this->slugs ) ) {

			$templates[] = "resources/views/{$this->name}/default.php";
		}

		$templates[] = "resources/views/{$this->name}.php";

		return apply_filters( app()->namespace . "/view_hierarchy_{$this->name}", $templates );
	}

	public function render() {

		// Locate the template.
		$this->locate();

		if ( $this->template ) {

			// Make `$data` available to the template.
			${ app()->config_view['name'] } = (object) $this->data;

			// Extract the data into individual variables if set.
			if ( app()->config_view['extract'] ) {

				extract( $this->data );
			}

			// Load the template.
			include( $this->template );
		}
	}

	public function fetch() {

		ob_start();
		$this->render();
		return ob_get_clean();
	}
}
