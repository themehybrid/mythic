<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<?php the_post_thumbnail( 'mythic-medium', [ 'class' => 'entry__image' ] ) ?>

	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Theme\Post\display_author() ?>
			<?php Hybrid\Theme\Post\display_date( [ 'before' => Mythic\sep() ] ) ?>
			<?php Hybrid\Theme\Post\display_comments_link( [ 'before' => Mythic\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>

</article>
