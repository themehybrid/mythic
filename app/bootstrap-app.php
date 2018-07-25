<?php
/**
 * Theme bootstrap file.
 *
 * This file is used to create a new application instance and bind items to the
 * container. This is the heart of the application.
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/mythic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

# ------------------------------------------------------------------------------
# Create a new application.
# ------------------------------------------------------------------------------
#
# Creates the one true instance of the Hybrid Core application. You may access
# this directly via the `\Hybrid\app()` function or `\Hybrid\App` static class
# after the application has booted.

$mythic = new \Hybrid\Core\Application();

# ------------------------------------------------------------------------------
# Add bindings to the container.
# ------------------------------------------------------------------------------
#
# Before booting the application, add any bindings to the container that are
# necessary to run the theme.

# Register customize class instance and boot it.
$mythic->instance( 'mythic/customize', new \Mythic\Customize\Customize() )->boot();

# Register the Laravel Mix manifest for cache-busting.
$mythic->singleton( 'mythic/mix', function() {
	$file = get_theme_file_path( 'dist/mix-manifest.json' );

	return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
} );

# ------------------------------------------------------------------------------
# Perform bootstrap actions.
# ------------------------------------------------------------------------------
#
# Creates an action hook for child themes (or even plugins) to hook into the
# bootstrapping process and add their own bindings before the app is booted by
# passing the application instance to the action callback.

do_action( 'mythic/bootstrap', $mythic );

# ------------------------------------------------------------------------------
# Bootstrap the application.
# ------------------------------------------------------------------------------
#
# Calls the application `boot()` method, which launches the application. Pat
# yourself on the back for a job well done.

$mythic->boot();
