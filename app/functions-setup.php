<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks with
 * some opinionated priorities based on theme dev, particularly working with child
 * theme devs/users, over the years.  I've also decided to use anonymous functions
 * to keep these from being easily unhooked.  WordPress has an appropriate API for
 * unregistering, removing, or modifying all of the things in this file.  Those APIs
 * should be used instead of attempting to use `remove_action()`.
 *
 * @package    ABC
 * @subpackage Includes
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2018, Justin Tadlock
 * @link       https://themehybrid.com/themes/abc
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

/**
 * Set up theme support.  This is where calls to `add_theme_support()` happen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	// Add title tag support.
	// @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	add_theme_support( 'title-tag' );

	// Add selective refresh for widgets.
	// @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

}, 5 );

/**
 * Adds support for the custom background feature. This is in its own function
 * hooked to `after_setup_theme` so that we can give it a later priority.  This
 * is so that child themes can more easily overwrite this feature.  Note that
 * overwriting the background should be done *before* rather than after.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'custom-background' );

}, 15 );

/**
 * Adds support for the custom header feature. This is in its own function
 * hooked to `after_setup_theme` so that we can give it a later priority.  This
 * is so that child themes can more easily overwrite this feature.  Note that
 * overwriting the header should be done *before* rather than after.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/#custom-header
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'custom-header' );

}, 15 );

/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary' => esc_html_x( 'Primary', 'nav menu location' )
	] );

}, 5 );

/**
 * Register image sizes.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	// Set the `post-thumbnail` size.
	// @link https://developer.wordpress.org/reference/functions/set_post_thumbnail_size/
	set_post_thumbnail_size( 178, 100, true );

	// Register custom image sizes.
	// @link https://developer.wordpress.org/reference/functions/add_image_size/
	add_image_size( app()->namespace . '/medium', 750, 422, true );
}, 5 );

/**
 * Register sidebars.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_sidebar/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'widgets_init', function() {

	$args = [
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>'
	];

	register_sidebar( [
		'id'   => 'primary',
		'name' => esc_html_x( 'Primary', 'sidebar' )
	] + $args );

}, 5 );

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_enqueue_script(
		app()->namespace . '/app',
		config( 'theme' )->uri . 'resources/dist/js/app.min.js',
		null,
		config( 'theme' )->version,
		true
	);

	wp_enqueue_style(
		app()->namespace . '/screen',
		config( 'theme' )->uri . 'resources/dist/css/screen.min.css',
		null,
		config( 'theme' )->version
	);

}, 5 );
