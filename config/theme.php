<?php

return [

	/*
	 |-------------------------------------------------------------------------
	 | Theme namespace.
	 |-------------------------------------------------------------------------
	 |
	 | A prefix/namespace used for filter hooks and such in the theme.
	 |
	 */
	 'namespace' => get_template(),

	/*
 	 |-------------------------------------------------------------------------
 	 | Theme version.
 	 |-------------------------------------------------------------------------
 	 |
 	 | The version number for the theme (used mostly for script/styles).
 	 |
 	 */
 	 'version' => wp_get_theme( get_template() )->get( 'Version' ),

	/*
	 |-------------------------------------------------------------------------
	 | Theme Directory Path
	 |-------------------------------------------------------------------------
	 |
	 | The absolute path to the theme directory (e.g., `/htdocs/wp-content/themes/abc`).
	 |
	 */

	'dir' => trailingslashit( get_parent_theme_file_path() ),

	/*
	 |-------------------------------------------------------------------------
	 | Theme Directory URI
	 |-------------------------------------------------------------------------
	 |
	 | URI to the theme directory (e.g., `http://localhost/wp-content/themes/abc`).
	 |
	 */

	'uri' => trailingslashit( get_parent_theme_file_uri() )
];
