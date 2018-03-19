<?php

// Load header/* template.
Hybrid\render_view( 'header', ABC\get_template_hierarchy() );

// Load content/* template.
Hybrid\render_view( 'content', ABC\get_template_hierarchy() );

// Load sidebar/* template.
Hybrid\render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] );

// Load footer/* template.
Hybrid\render_view( 'footer', ABC\get_template_hierarchy() );
