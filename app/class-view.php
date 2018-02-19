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

		// Make `$data` available to the template.
		$data = $this->data;

		if ( $this->template ) {

			include( $this->template );
		}
	}

	public function fetch() {

		ob_start();
		$this->render();
		return ob_get_clean();
	}
}
