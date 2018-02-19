<?php

namespace ABC;

function get_view( $name, $slugs = [], $data = [] ) {

	return new View( $name, $slugs, $data );
}

function render_view( $name, $slugs = [], $data = [] ) {

	get_view( $name, $slugs, $data )->render();
}

function fetch_view( $name, $slugs = [], $data = [] ) {

	get_view( $name, $slugs, $data )->fetch();
}
