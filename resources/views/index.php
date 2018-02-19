<?php use function ABC\render_view; // Imports the `render_view()` function. ?>

<?php render_view( 'header' ) ?>

<main class="site__content">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php render_view( 'entry' ) ?>

	<?php endwhile; endif;  ?>

</main>

<?php render_view( 'sidebar', [ 'primary' ], [ 'name' => 'primary' ] ) ?>

<?php render_view( 'footer' ) ?>
