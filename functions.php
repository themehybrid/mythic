<?php
/**
 * Theme functions file.
 *
 * This file is used to bootstrap the theme.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace ABC;

use function Hybrid\app;
use function Hybrid\autoload;

# Auto-load any projects via the Composer autoloader. Be sure to check if the
# file exists in case someone's using Composer to load their dependencies in
# a different directory.
if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
        require_once( get_parent_theme_file_path( 'vendor/autoload.php' ) );
}

# Bootstrap the theme.
#
# If the theme needs a more robust bootstrapping process, it's recommended to
# create a `/bootstrap` folder and load those bootstrap files from here.

# Register an autoloader for handling class loading. We're using Hybrid Core's
# built-in autoloader for simplicity. Class names should be in Pascal Case (e.g.,
# `HelloWorld`) and file names prefixed with `class-` and hyphenated (e.g.,
# `class-hello-world.php`). You can also build your own autoloader or utilize
# the autoloader in Composer.
spl_autoload_register( function( $class ) {

        autoload( $class, [
                'namespace' => __NAMESPACE__,
                'path'      => get_parent_theme_file_path( 'app' )
        ] );
} );

# Load any functions-files from the `/app` folder that are needed. Add additional
# files to the array without the `.php` extension.
array_map(
	function( $file ) {
		require_once( get_parent_theme_file_path( "app/{$file}.php" ) );
	},
	[
		'functions-setup',
		'functions-template'
	]
);

# Registers a single instance of our `Customize` class with the container.
app()->singleton( 'abc/customize', function() {
        return new Customize();
} );

# Resolves the single customize instance.
app()->get( 'abc/customize' );
