<?php
/**
 * Filter functions.
 *
 * This file holds functions that are used for filtering.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

/**
 * Filters the WP nav menu item CSS classes.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $classes
 * @return array
 */
add_filter( 'nav_menu_css_class', function( $classes ) {

	$_classes = [ 'menu__item' ];

	foreach ( [ 'item', 'parent', 'ancestor' ] as $type ) {

		if ( in_array( "current-menu-{$type}", $classes ) ) {

			$_classes[] = "menu__item--{$type}";
		}
	}

	return $_classes;

}, PHP_INT_MIN );

/**
 * Filters the WP nav menu link attributes.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $attr
 * @return array
 */
add_filter( 'nav_menu_link_attributes', function( $attr ) {

	$attr['class'] = 'menu__anchor';

	return $attr;

}, PHP_INT_MIN );

/**
 * Overwrites the HTML classes for the comment form default fields.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $fields
 * @return array
 */
add_filter( 'comment_form_default_fields', function( $fields ) {

	array_walk( $fields, function( &$field, $key ) {

	 	$field = replace_html_class(
			"comment-respond__field comment-respond__field--{$key}",
			$field
		);
	} );

	return $fields;

}, PHP_INT_MIN );

/**
 * Overwrites the HTML classes for various comment form elements.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $defaults
 * @return array
 */
add_filter( 'comment_form_defaults', function( $defaults ) {

	// Classes we can set.
	$defaults['class_form']   = 'comment-respond__form';
	$defaults['class_submit'] = 'comment-respond__submit';

	// Field wrappers.
	$defaults['comment_field'] = replace_html_class( 'comment-respond__field comment-respond__field--comment', $defaults['comment_field'] );
	$defaults['submit_field']  = replace_html_class( 'comment-respond__field comment-respond__field--submit',  $defaults['submit_field']  );

	// Other elements.
	$defaults['must_log_in']          = replace_html_class( 'comment-respond__must-log-in',  $defaults['must_log_in']          );
	$defaults['logged_in_as']         = replace_html_class( 'comment-respond__logged-in-as', $defaults['logged_in_as']         );
	$defaults['comment_notes_before'] = replace_html_class( 'comment-respond__notes',        $defaults['comment_notes_before'] );
	$defaults['title_reply_before']   = replace_html_class( 'comment-respond__reply-title',  $defaults['title_reply_before']   );

	return $defaults;

}, PHP_INT_MIN );

/**
 * Helper function for replacing a class in an HTML string.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $class
 * @param  string  $html
 * @return string
 */
function replace_html_class( $class, $html ) {

	return preg_replace(
		"/class=(['\"]).+?(['\"])/i",
		'class=$1' . esc_attr( $class ) . '$2',
		$html,
		1
	);
}
