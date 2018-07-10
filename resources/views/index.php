<?php

// Load header/* template.
Hybrid\View\render( 'header', Hybrid\get_global_hierarchy() );

// Load content/* template.
Hybrid\View\render( 'content', Hybrid\get_global_hierarchy() );

// Load footer/* template.
Hybrid\View\render( 'footer', Hybrid\get_global_hierarchy() );
