<div class="app-content">

	<main id="main" class="app-main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php Hybrid\View\display( 'entry/single', Hybrid\Post\hierarchy() ) ?>

				<?php comments_template() ?>

			<?php endwhile ?>

		<?php endif ?>

	</main>

	<?php Hybrid\View\display( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ) ?>

</div>
