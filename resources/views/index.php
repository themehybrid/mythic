<?php namespace ABC;

// Load header template.
render_view( 'header', get_template_base() );

// Load content template.
render_view( 'content', get_template_base() );

// Load sidebar template.
render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] );

// Load footer template.
render_view( 'footer', get_template_base() );
