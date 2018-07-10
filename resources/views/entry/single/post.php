<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title() ?></h1>

		<div class="entry__byline">
			<?php Hybrid\Post\render_author() ?>
			<?php Hybrid\Post\render_date( [ 'before' => ABC\get_meta_sep() ] ) ?>
			<?php Hybrid\Post\render_comments_link( [ 'before' => ABC\get_meta_sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
	</div>

	<footer class="entry__footer">
		<?php Hybrid\Post\render_terms( [ 'taxonomy' => 'category' ] ) ?>
		<?php Hybrid\Post\render_terms( [ 'taxonomy' => 'post_tag', 'before' => ABC\get_meta_sep() ] ) ?>
	</footer>

</article>
