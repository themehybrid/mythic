<?php namespace ABC; ?>

<main class="site__content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php render_view( 'entry', get_post_type() ) ?>

		<?php endwhile ?>

	<?php endif ?>

</main>
