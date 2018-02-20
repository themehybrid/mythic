<?php
/**
 * The primary view class for handling the output of templates within the theme.
 */

namespace ABC;

/**
 * View class.
 *
 * @since  1.0.0
 * @access public
 */
class View {

	/**
	 * Name of the view. This is primarily used as the folder name. However,
	 * it can also be the filename as the finall fallback if no folder exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	protected $name = '';

	/**
	 * Array of slugs to look for. This creates the hierarchy based on the
	 * `$name` property (e.g., `{$name}/{$slug}.php`). Slugs are used in
	 * the order that they are set.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	protected $slugs = [];

	/**
	 * An array of data that is passed into the view template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	protected $data = [];

	/**
	 * The template filename.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	protected $template = '';

	/**
	 * Sets up the view properties.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $slugs
	 * @param  array   $data
	 * @return object
	 */
	public function __construct( $name, $slugs = [], $data = [] ) {

		$this->name  = $name;
		$this->slugs = (array) apply_filters( app()->namespace . "/view_slugs_{$this->name}", $slugs );
		$this->data  = (array) apply_filters( app()->namespace . "/view_data_{$this->name}",  $data  );
	}

	/**
	 * Locates the template using the core WordPress `locate_template()` function.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function locate() {

		$this->template = locate_template( $this->get_hierarchy(), false, false );
	}

	/**
	 * Uses the array of template slugs to build a hierarchy of potential
	 * templates that can be used.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	protected function get_hierarchy() {

		// Uses the slugs to build a hierarchy.
		foreach ( $this->slugs as $slug ) {

			$templates[] = "resources/views/{$this->name}/{$slug}.php";
		}

		// Add in a `default.php` template.
		if ( ! in_array( 'default', $this->slugs ) ) {

			$templates[] = "resources/views/{$this->name}/default.php";
		}

		// Fallback to `{$name}.php` as a last resort.
		$templates[] = "resources/views/{$this->name}.php";

		// Allow developers to overwrite the hierarchy.
		return apply_filters(
			app()->namespace . "/view_hierarchy_{$this->name}",
			$templates,
			$this
		);
	}

	/**
	 * Sets up data to be passed to the template and renders it.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
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

	/**
	 * Returns the template output as a string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function fetch() {

		ob_start();
		$this->render();
		return ob_get_clean();
	}
}
