<?php
/**
 * App bootstrap.
 *
 * This file bootstraps the theme.  It sets up the single, one-true instance
 * of the app, which can be accessed via the `app()` function.  The file is
 * used to configure any "global" configuration and load any functions-files
 * that are needed for the theme.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

// Change the Hybrid Core framework directory path and URI.
define( 'HYBRID_DIR', trailingslashit( get_parent_theme_file_path( 'vendor/justintadlock/hybrid-core' ) ) );
define( 'HYBRID_URI', trailingslashit( get_parent_theme_file_uri(  'vendor/justintadlock/hybrid-core' ) ) );

// Load Hybrid Core.
require_once( HYBRID_DIR . 'hybrid.php' );

/**
 * The single instance of the app. Use this function for quickly working
 * with data.  Returns an instance of the `Container` class.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function app() {

	static $app = null;

	if ( is_null( $app ) ) {
		$app = new Container();
	}

	return $app;
}

// Add our theme wrapper.
app()->add( 'wrapper', function( $container ) {

	return new Wrapper();
} );

// Add configuration.
app()->add( 'config.theme', function( $container ) {

	return new Collection( require_once( get_parent_theme_file_path( 'config/theme.php' ) ) );
} );

app()->add( 'config.view', function() {

	return new Collection( require_once( get_parent_theme_file_path( 'config/view.php' ) ) );
} );

// Use the theme namespace as the overall app namespace.
app()->add( 'namespace', app()->get( 'config.theme' )->namespace );

// Resolve theme wrapper.
app()->get( 'wrapper' );

// Load functions files.
array_map(
	function( $file ) {
		require_once( get_parent_theme_file_path( "app/{$file}.php" ) );
	},
	// Add file names of files to auto-load from the `/app` folder.
	// Classes are auto-loaded, so we only need this for functions-files.
	[
		'functions-setup',
		'functions-template'
	]
);

// Runs after the app has been bootstrapped.
do_action( app()->namespace . '/app_bootstrapped', app() );
