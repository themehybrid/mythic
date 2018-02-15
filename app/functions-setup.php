<?php

/**
 * Set up theme support.
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'title-tag' );

}, 5 );

/**
 * Register menus.
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary' => esc_html__x( 'Primary', 'nav menu location', 'abc' )
	] );

}, 5 );

/**
 * Register image sizes.
 */
add_action( 'init', function() {

	register_image_size( app()->namespace . '/')
})

/**
 * Register sidebars.
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
		'name' => esc_html_x( 'Primary', 'sidebar', 'abc' )
	] + $args );

}, 5 );

/**
 * Enqueue scripts/styles.
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_enqueue_style( 'abc-screen', app()->uri . 'resources/css/screen.min.css' );
}, 5 );
