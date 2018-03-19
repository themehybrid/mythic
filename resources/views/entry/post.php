<article <?php Hybrid\attr( 'entry' ) ?>>

	<?php if ( is_single( get_the_ID() ) ) : ?>

		<header class="entry__header">
			<h1 class="entry__title"><?php single_post_title() ?></h1>

			<div class="entry__byline">
				<?php Hybrid\post_author() ?>
				<?php Hybrid\post_date( [ 'before' => ABC\get_meta_sep() ] ) ?>
				<?php Hybrid\post_comments( [ 'before' => ABC\get_meta_sep() ] ) ?>
			</div>
		</header>

		<div class="entry__content">
			<?php the_content() ?>
			<?php Hybrid\render_view( 'partials', 'pagination-singular' ) ?>
		</div>

		<footer class="entry__foooter">
			<?php Hybrid\post_terms( [ 'taxonomy' => 'category' ] ) ?>
			<?php Hybrid\post_terms( [ 'taxonomy' => 'post_tag', 'before' => ABC\get_meta_sep() ] ) ?>
		</footer>

	<?php else : ?>

		<header class="entry__header">
			<h2 class="entry__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

			<div class="entry__byline">
				<?php Hybrid\post_author() ?>
				<?php Hybrid\post_date( [ 'before' => ABC\get_meta_sep() ] ) ?>
				<?php Hybrid\post_comments( [ 'before' => ABC\get_meta_sep() ] ) ?>
			</div>
		</header>

		<div class="entry__summary">
			<?php the_excerpt() ?>
		</div>

	<?php endif ?>

</article>
