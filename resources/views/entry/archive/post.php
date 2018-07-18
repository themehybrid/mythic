<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<?php the_post_thumbnail( 'mythic-medium', [ 'class' => 'entry__image' ] ) ?>

	<header class="entry__header">
		<h2 class="entry__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

		<div class="entry__byline">
			<?php Hybrid\Post\render_author() ?>
			<?php Hybrid\Post\render_date( [ 'before' => Mythic\sep() ] ) ?>
			<?php Hybrid\Post\render_comments_link( [ 'before' => Mythic\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>

</article>
