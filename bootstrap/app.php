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

		$dir = trailingslashit( get_parent_theme_file_path() );

		$app = new App();

		$app->add( 'wrapper', new Wrapper() );

		$app->config = [
			'theme' => new Registry( require_once( $dir . 'config/theme.php' ) ),
			'view'  => new Registry( require_once( $dir . 'config/view.php'  ) )
		];

		// Copy some theme config over as the app properties.
		$app->dir       = $app->config['theme']['dir'];
		$app->uri       = $app->config['theme']['uri'];
		$app->namespace = $app->config['theme']['namespace'];
	}

	return $app;
}

// Load the app.
app();

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
