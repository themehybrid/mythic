<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Post\render_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Post\render_author() ?>
			<?php Hybrid\Post\render_date( [ 'before' => Mythic\sep() ] ) ?>
			<?php Hybrid\Post\render_comments_link( [ 'before' => Mythic\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'nav/pagination', 'post' ) ?>
	</div>

	<footer class="entry__footer">
		<?php Hybrid\Post\render_terms( [ 'taxonomy' => 'category' ] ) ?>
		<?php Hybrid\Post\render_terms( [ 'taxonomy' => 'post_tag', 'before' => Mythic\sep() ] ) ?>
	</footer>

</article>
