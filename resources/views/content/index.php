<div class="app-content">

	<main id="main" class="app-main">

		<?php Hybrid\View\render( 'partials', 'archive-header' ) ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php Hybrid\View\render( 'entry/archive', Hybrid\get_post_hierarchy() ) ?>

			<?php endwhile ?>

			<?php Hybrid\View\render( 'partials', 'pagination-posts' ) ?>

		<?php endif ?>

	</main>

	<?php Hybrid\View\render( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>

</div>
