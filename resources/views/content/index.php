<main class="app-main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\render_view( 'entry', Hybrid\get_post_hierarchy() ) ?>

			<?php if ( is_singular() ) : ?>

				<?php comments_template( '/resources/views/partials/comments.php' ) ?>

			<?php endif ?>

		<?php endwhile ?>

		<?php if ( Hybrid\is_plural() ) : ?>

			<?php Hybrid\render_view( 'partials', 'pagination-posts' ) ?>

		<?php endif ?>

	<?php endif ?>

</main>
