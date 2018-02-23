<?php
/**
 * Query template wrapper class.
 *
 * This is a wrapper for the queried template in core WordPress. This is
 * the top-level template loaded.  This wrapper looks for templates in
 * the `/resources/views/content` folder by default.  This is the "content"
 * of the page and represents the "base" template.  The wrapper template
 * (or what might be called the "layout" template) is located in the
 * `/resources/views` folder.  The wrapper template becomes the top-level
 * template on output.
 *
 * This allows theme authors to build the wrapping HTML once without having
 * to repeat common code while building unique content templates when they
 * need to build something custom.  The content templates utilize the normal
 * template hierarchy.
 *
 * It should be noted that plugins that filter `template_include` to overwrite
 * the final template should be respected.  In those cases, the wrapper will
 * attempt to bail and let the plugin do its own thing.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

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
	 * @access protected
	 * @var    array
	 */
	protected $types = [
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

		// If the template is not a string at this point, it either
		// doesn't exist or a plugin is telling us it's doing
		// something custom.
		if ( ! is_string( $template ) ) {

			return $template;
		}

		// Strip the template and stylesheet directory from the file name.
		$file = ltrim( str_replace( [ get_template_directory(), get_stylesheet_directory() ], '', $template ), '/' );

		// Check that our template is a content template from the theme.
		if ( 0 === strpos( $file, 'resources/views/content' ) ) {

			// Get the file basename and remove the `.php` file extension to get the base.
			$this->base = substr( basename( $template ), 0, -4 );

			// Build a hierarchy of wrapper templates.
			$templates = [ "{$this->base}.php" ];

			// Always fall back to `index.php`.
			if ( 'index' !== $this->base ) {

				$templates[] = 'index.php';
			}

			// Return the located template.
			return locate_template( $templates );
		}

		return $template;
	}
}
