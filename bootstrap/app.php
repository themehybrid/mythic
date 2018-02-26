<?php

namespace ABC;

/**
 * The single instance of the app. Use this function for quickly working
 * with data.  Returns an instance of the `App` class.
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
app()->add( 'config.theme', function() {
	return new Registry( require_once( get_parent_theme_file_path( 'config/theme.php' ) ) );
} );

app()->add( 'config.view', function() {
	return new Registry( require_once( get_parent_theme_file_path( 'config/view.php' ) ) );
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
