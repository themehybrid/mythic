<?php

namespace ABC;

/**
 * Theme template wrapper based on Scribu's theme wrappers.
 *
 * @link    http://scribu.net/wordpress/theme-wrappers.html
 * @author  Cristi Burcă (scribu)
 * @license Public Domain
 *
 * @since  1.0.0
 * @access public
 */
class Wrapper {

	/**
	 * Array of template types in core WP.
	 *
	 * @link   https://developer.wordpress.org/reference/hooks/type_template_hierarchy/
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $types = [
		'index',
		'404',
		'archive',
		'author',
		'category',
		'tag',
		'taxonomy',
		'date',
		'embed',
		'home',
		'frontpage',
		'page',
		'paged',
		'search',
		'single',
		'singular',
		'attachment'
	];

	/**
	 * Base name of template that is found via `locate_template()` without
	 * the `.php` extension.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $base = 'index';

	/**
	 * Adds filters on WP's template system.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		foreach ( $this->types as $type ) {

			add_filter( "{$type}_template_hierarchy", array( $this, 'template_hierarchy' ), PHP_INT_MAX );
		}

		add_filter( 'template_include', array( $this, 'template_include' ), PHP_INT_MAX );
	}

	/**
	 * Filters the template hierarchy for each type of template and looks
	 * templates within `resources/views/content`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function template_hierarchy( $templates ) {

		return str_replace(
			'resources/views',
			'resources/views/content',
			filter_templates( $templates )
		);
	}

	/**
	 * Filters on `template_include` to load a "wrapper" or "layout" template.
	 * At this point, WordPress has already located the appropriate template to
	 * load. Given that we filtered the template type hierarchies earlier, we
	 * want to check that the found template is in our content templates folder.
	 * If so, we'll load a wrapper.  Otherwise, we assume that a plugin is doing
	 * something custom and let them do their thing.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $template
	 * @return string
	 */
	public function template_include( $template ) {

		if ( ! is_string( $template ) )
			return $template;

		// Strip the template and stylesheet directory from the file name.
		$file = ltrim( str_replace( [ get_template_directory(), get_stylesheet_directory() ], '', $template ), '/' );

		$needle = 'resources/views/content';

		// Check that our template is a content template from the theme.
		if ( '' != $needle && 0 === strpos( $file, $needle ) ) {

			// Get the file basename and remove the `.php` file extension to get the base.
			$this->base = substr( basename( $template ), 0, -4 );

			// Build a hierarchy of wrapper templates.
			$templates = [ "{$this->base}.php" ];

			if ( 'index' !== $this->base ) {

				$templates[] = 'index.php';
			}

			// Return the located template.
			return locate_template( $templates );
		}

		return $template;
	}
}
