<?php

namespace ABC;

/**
 * Autoloader for the theme.  Looks in the `/app` folder for classes.
 * File names are prefixed with `class-` and are a lowercased version
 * of the class name.  Classes with an underscore in the name are
 * hyphenated in the file name.
 *
 * `ABC\My_Class`       = `/app/class-my-class.php`
 * `ABC\Admin\My_Class` = `/app/admin/class-my-class.php`
 *
 * @since  1.0.0
 * @access public
 * @param  string  $class
 * @return void
 */
spl_autoload_register( function( $class ) {

	$namespace = __NAMESPACE__ . '\\';

	if ( 0 !== strpos( $class, $namespace ) ) {
		return;
	}

	$file = strtolower(
		// Remove the namespace, replace underscores with hyphens,
		// and replace backslashes with forward slashes.
		str_replace( [ $namespace, '_', '\\' ], [ '', '-', '/' ], $class )
	);

	$file = get_parent_theme_file_path( "app/class-{$file}.php" );

	if ( file_exists( $file ) ) {
		include( $file );
	}
} );
