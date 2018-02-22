<?php namespace ABC; ?>

<?php render_view( 'header', get_template_base() ) ?>

<?php render_view( 'content', get_template_base() ) ?>

<?php render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>

<?php render_view( 'footer', get_template_base() ) ?>
