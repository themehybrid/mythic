<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Theme\Post\display_author() ?>
			<?php Hybrid\Theme\Post\display_date( [ 'before' => Mythic\sep() ] ) ?>
			<?php Hybrid\Theme\Post\display_comments_link( [ 'before' => Mythic\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

	<footer class="entry__footer">
		<?php Hybrid\Theme\Post\display_terms( [ 'taxonomy' => 'category' ] ) ?>
		<?php Hybrid\Theme\Post\display_terms( [ 'taxonomy' => 'post_tag', 'before' => Mythic\sep() ] ) ?>
	</footer>

</article>
