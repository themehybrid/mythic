<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<?php the_post_thumbnail( 'mythic-medium', [ 'class' => 'entry__image' ] ) ?>

	<header class="entry__header">
		<?php Hybrid\Post\render_title() ?>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>

</article>
