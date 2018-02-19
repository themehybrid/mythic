<?php

namespace ABC;

require_once( trailingslashit( get_template_directory() ) . 'vendor/autoload.php' );

define( 'HYBRID_DIR', trailingslashit( get_parent_theme_file_path( 'vendor/justintadlock/hybrid-core' ) ) );
define( 'HYBRID_URI', trailingslashit( get_parent_theme_file_uri(  'vendor/justintadlock/hybrid-core' ) ) );

require_once( HYBRID_DIR . 'hybrid.php' );

require_once( get_parent_theme_file_path( 'bootstrap/app.php' ) );
