<?php
/**
 * Template tags.
 *
 * This file holds template tags for the theme. Template tags are PHP functions
 * meant for use within theme templates.
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/mythic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Mythic;

/**
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $sep
 * @return string
 */
function sep( $sep = '' ) {

	return apply_filters(
		'mythic/sep',
		sprintf(
			' <span class="sep">%s</span> ',
			$sep ?: esc_html_x( '&middot;', 'meta separator' )
		)
	);
}

/**
 * Displays the header image.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function display_header_image() {

	echo render_header_image();
}

/**
 * Returns the header image HTML.
 *
 * @since  1.0.0
 * @access public
 * @return string  Header image HTML.
 */
function render_header_image() {

	// Bail if there's no header image set.
	if ( ! get_header_image() ) {
		return '';
	}

	// Build the header image HTML.
	$image = sprintf(
		'<img class="app-header__image" src="%s" width="%s" height="%s" alt="" />',
		esc_url( get_header_image() ),
		esc_attr( get_custom_header()->width ),
		esc_attr( get_custom_header()->height )
	);

	// If there's no header text, link the header image to the home page.
	if ( ! display_header_text() ) {

		$image = sprintf(
			'<a class="app-header__image-link" href="%s" title="%s" rel="home">%s</a>',
			esc_url( home_url() ),
			esc_attr( get_bloginfo( 'name' ) ),
			$image
		);
	}

	return $image;
}
