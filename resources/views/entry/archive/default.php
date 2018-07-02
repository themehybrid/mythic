<article <?php Hybrid\attr( 'entry' ) ?>>

	<?php the_post_thumbnail( 'abc-medium', [ 'class' => 'entry__image' ] ) ?>

	<header class="entry__header">
		<h2 class="entry__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>

</article>
