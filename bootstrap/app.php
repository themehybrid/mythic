<?php

namespace ABC;

use League\Plates\Engine;

// Wrapper function to access the engine/app.
// Single instance of our app.
function app() {

	static $app = null;

	if ( is_null( $app ) ) {

		require_once( get_parent_theme_file_path( 'app/class-container.php' ) );

		$views = trailingslashit( get_template_directory() ) . 'resources/views';

		$plates = Engine::create( $views, 'php' );

		$plates->addConfig( [ 'render_context_var_name' => 'view'] );

		$folders = [ 'comment', 'entry', 'footer', 'header', 'layout', 'menu', 'sidebar' ];

		foreach ( $folders as $folder ) {

			$plates->addFolder( $folder, "{$views}/{$folder}" );
		}

		$container = new Container();

		$container->add( 'views', $plates );

		$app = $container; // new App() later.
	}

	return $app;
}

app();
