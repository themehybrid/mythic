<?php

return [

	/**
	 |-------------------------------------------------------------------------
	 | Theme Directory Path
	 |-------------------------------------------------------------------------
	 |
	 | The absolute path to the theme directory (e.g., `/htdocs/wp-content/themes/abc`).
	 |
	 */

	'dir' = trailingslashit( get_parent_theme_file_path() ),

	/**
	 |-------------------------------------------------------------------------
	 | Theme Directory URI
	 |-------------------------------------------------------------------------
	 |
	 | URI to the theme directory (e.g., `http://localhost/wp-content/themes/abc`).
	 |
	 */

	'uri' = trailingslashit( get_parent_theme_file_uri() )
];
