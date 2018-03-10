<?php
/**
 * Query template wrapper class.
 *
 * This class creates a modular template system by capturing the entire
 * template hierarchy for the page.  Because this hierarchy is captured,
 * it can be later retrieved in used in things like template parts,
 * allowing partial templates to have their own, complete hierarchy.
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
 * Theme template wrapper based on Koop's modular themes.
 *
 * @link    https://core.trac.wordpress.org/ticket/12877
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
	 * Copy of the located template found when running through
	 * the template hierarchy.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $located = '';

	/**
	 * An array of the entire template hierarchy for the current
	 * page view. This hierarchy does not have the `.php` file
	 * name extension.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $hierarchy = [];

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

			add_filter( "{$type}_template", array( $this, 'template' ), PHP_INT_MAX );
		}

		add_filter( 'template_include', array( $this, 'template_include' ), PHP_INT_MAX );
	}

	/**
	 * Filters the template hierarchy for each type of template and looks
	 * templates within `resources/views`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function template_hierarchy( $templates ) {

		// Merge the current template's hierarchy with the
		// overall hierarchy array.
		$this->hierarchy = array_merge(
			$this->hierarchy,
			array_map( function( $template ) {

				// Strip extension from file name.
				return substr(
					$template,
					0,
					strlen( $template ) - strlen( strrchr( $template, '.' ) )
				);

			}, $templates )
		);

		return filter_templates( $templates );
	}

	/**
	 * Filters the template for each type of template in the hierarchy.
	 * If `$template` exists, it means we've located a template. So,
	 * we're going to store that template for later use and return an
	 * empty string so that the template hierarchy continues processing.
	 * That way, we can capture the entire hierarchy.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $template
	 * @return string
	 */
	public function template( $template ) {

		if ( ! $this->located && $template ) {
			$this->located = $template;
		}

		return '';
	}

	/**
	 * Filter on `template_include` to make sure we fall back to our
	 * located template from earlier.
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

		// If there's a template, return it. Otherwise, return our
		// located template from earlier.
		return $template ?: $this->located;
	}
}
