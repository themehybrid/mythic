<?php namespace ABC; ?>

<main class="site__content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php render_view( 'entry', get_post_type() ) ?>

			<?php if ( is_singular() ) : ?>

				<?php comments_template( '/resources/views/partials/comments.php' ) ?>

			<?php endif ?>

		<?php endwhile ?>

		<?php if ( hybrid_is_plural() ) : ?>

			<?php render_view( 'partials', 'pagination-posts' ) ?>

		<?php endif ?>

	<?php endif ?>

</main>
