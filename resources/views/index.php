<?php

// Load header/* template.
Hybrid\render_view( 'header', Hybrid\get_template_hierarchy() );

// Load content/* template.
Hybrid\render_view( 'content', Hybrid\get_template_hierarchy() );

// Load footer/* template.
Hybrid\render_view( 'footer', Hybrid\get_template_hierarchy() );
