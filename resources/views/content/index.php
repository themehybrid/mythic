<?php namespace ABC; ?>

<main class="site__content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php render_view( 'entry', get_post_type() ) ?>

			<?php if ( is_singular() ) : ?>

				<?php comments_template( '/resources/views/partials/comments.php' ) ?>

			<?php endif ?>

		<?php endwhile ?>

	<?php endif ?>

</main>
