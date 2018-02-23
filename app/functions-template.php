<?php
/**
 * Template functions.
 *
 * This file holds functions related to templates.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

/**
 * Returns a view object.
 *
 * @since  1.0.0
 * @access public
 * @param  string        $name
 * @param  array|string  $slugs
 * @param  array         $data
 * @return object
 */
function get_view( $name, $slugs = [], $data = [] ) {

	return new View( $name, $slugs, $data );
}

/**
 * Outputs a view template.
 *
 * @since  1.0.0
 * @access public
 * @param  string        $name
 * @param  array|string  $slugs
 * @param  array         $data
 * @return void
 */
function render_view( $name, $slugs = [], $data = [] ) {

	get_view( $name, $slugs, $data )->render();
}

/**
 * Returns a view template as a string.
 *
 * @since  1.0.0
 * @access public
 * @param  string        $name
 * @param  array|string  $slugs
 * @param  array         $data
 * @return string
 */
function fetch_view( $name, $slugs = [], $data = [] ) {

	return get_view( $name, $slugs, $data )->fetch();
}

/**
 * Wrapper for the core WP `locate_template()` function. Runs the templates
 * through `filter_templates()` to change the file paths.
 *
 * @since  1.0.0
 * @access public
 * @param  array|string  $templates
 * @param  bool          $load
 * @param  bool          $require_once
 * @return string
 */
function locate_template( $templates, $load = false, $require_once = true  ) {

	return \locate_template( filter_templates( (array) $templates ), $load, $require_once );
}

/**
 * Filters an array of templates and prefixes them with the
 * `/resources/views/` file path.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $templates
 * @return array
 */
function filter_templates( $templates ) {

	array_walk( $templates, function( &$template, $key ) {

		$path = 'resources/views';

		$template = ltrim( str_replace( $path, '', $template ), '/' );

		$template = "{$path}/{$template}";
	} );

	return $templates;
}

/**
 * Returns the template base from the theme wrapper.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function get_template_base() {

	return app()->get( 'wrapper' )->base;
}

/**
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $sep
 * @return string
 */
function get_meta_sep( $sep = '' ) {

	return apply_filters(
		app()->namespace . '/meta_sep',
		sprintf(
			'<span class="sep">%s</span>',
			$sep ? $sep : esc_html_x( '&middot;', 'meta separator' )
		)
	);
}
