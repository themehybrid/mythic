<?php
/**
 * Asset-related functions and filters.
 *
 * This file holds some setup actions for scripts and styles as well as a helper
 * functions for work with assets.
 *
 * @package    ABC
 * @subpackage Includes
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2018, Justin Tadlock
 * @link       https://themehybrid.com/themes/abc
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

use function Hybrid\app;

/**
 * Enqueue scripts/styles for the front end.
 *
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_enqueue_script( 'abc-app', asset( 'scripts/app.js' ), null, null, true );

	wp_enqueue_style( 'abc-screen', asset( 'styles/screen.css' ), null, null );

}, 5 );

/**
 * Enqueue scripts/styles for the editor.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'enqueue_block_editor_assets', function() {

	wp_enqueue_style( 'abc-editor', asset( 'styles/editor.css' ), null, null );

}, 5 );

/**
 * Helper function for outputting an asset URL in the theme. This integrates
 * with Laravel Mix for handling cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the filename.
 *
 * @link   https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 * @since  1.0.0
 * @access public
 * @param  string  $path
 * @return string
 */
function asset( $path ) {

	// Get the Laravel Mix manifest.
	$manifest = mix();

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_theme_file_uri( 'dist' . $path );
}

/**
 * Returns the Laravel Mix manifest.
 *
 * Note that `file_get_contents()` is not allowed on WordPress.org. If building
 * a theme for the WP directory, you'll need to remove this function and the
 * reference to it in the `asset()` function.
 *
 * @link   https://github.com/WordPress/theme-check/issues/55
 * @link   https://wordpress.stackexchange.com/questions/166161/why-cant-the-wp-filesystem-api-read-googlefonts-json/166175
 *
 * @since  1.0.0
 * @access public
 * @return array|false
 */
function mix() {
	$manifest = app( 'abc/mix' );

	// If there is no manifest saved yet, let's see if we can find one.
	if ( ! $manifest ) {

		$file = get_theme_file_path( 'dist/mix-manifest.json' );

		if ( file_exists( $file ) ) {
			$manifest = json_decode( file_get_contents( $file ), true );

			if ( $manifest ) {
				app()->add( 'abc/mix', $manifest );
			}
		}
	}

	return $manifest;
}
