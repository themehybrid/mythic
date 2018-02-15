<?php

namespace ABC;

require_once( trailingslashit( get_template_directory() ) . 'vendor/autoload.php' );

require_once( get_parent_theme_file_path( 'bootstrap/app.php' ) );

function templates() {

	return app()->get( 'views' );
}
