<?php

namespace ABC;

function get_view( $name, $slugs = [], $data = [] ) {

	return new View( $name, $slugs, $data );
}

function render_view( $name, $slugs = [], $data = [] ) {

	get_view( $name, $slugs, $data )->render();
}

function fetch_view( $name, $slugs = [], $data = [] ) {

	return get_view( $name, $slugs, $data )->fetch();
}

function locate_template( $templates, $load = false, $require_once = true  ) {

	return \locate_template( filter_templates( $templates ), $load, $require_once );
}

function filter_templates( $templates ) {

	array_walk( $templates, function( &$template, $key ) {

		$path = 'resources/views';

		$template = ltrim( str_replace( $path, '', $template ), '/' );

		$template = "{$path}/{$template}";
	} );

	return $templates;
}

function get_template_base() {

	return app()->get( 'wrapper' )->base;
}

function get_meta_sep( $sep = '' ) {

	return apply_filters(
		app()->namespace . '/meta_sep',
		sprintf(
			'<span class="sep">%s</span>',
			$sep ? $sep : _x( '&middot;', 'meta separator' )
		)
	);
}
