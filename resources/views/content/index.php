<div class="app-content">

	<main class="app-main">

		<?php Hybrid\render_view( 'partials', 'archive-header' ) ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php Hybrid\render_view( 'entry/archive', Hybrid\get_post_hierarchy() ) ?>

			<?php endwhile ?>

			<?php Hybrid\render_view( 'partials', 'pagination-posts' ) ?>

		<?php endif ?>

	</main>

	<?php Hybrid\render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>

</div>
