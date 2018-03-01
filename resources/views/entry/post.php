<?php namespace ABC; ?>

<article <?php hybrid_attr( 'entry' ) ?>>

	<?php if ( is_single( get_the_ID() ) ) : ?>

		<header class="entry__header">
			<h1 class="entry__title"><?php single_post_title() ?></h1>

			<div class="entry__byline">
				<?php hybrid_post_author( [ 'wrap' => '<span class="entry__author">%2$s</span>' ] ) ?>
				<?= get_meta_sep() ?>
				<time class="entry__published"><?= get_the_date() ?></time>
				<?= get_meta_sep() ?>
				<?php comments_popup_link( false, false, false, 'entry__comments-link' ) ?>
			</div>
		</header>

		<div class="entry__content">
			<?php the_content() ?>
			<?php wp_link_pages() ?>
		</div>

		<footer class="entry__foooter">
			<?php hybrid_post_terms( [ 'taxonomy' => 'category' ] ) ?>
			<?php hybrid_post_terms( [ 'taxonomy' => 'post_tag', 'before' => get_meta_sep() ] ) ?>
		</footer>

	<?php else : ?>

		<header class="entry__header">
			<h2 class="entry__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

			<div class="entry__byline">
				<?php hybrid_post_author( [ 'wrap' => '<span class="entry__author">%2$s</span>' ] ) ?>
				<?= get_meta_sep() ?>
				<time class="entry__published"><?= get_the_date() ?></time>
				<?= get_meta_sep() ?>
				<?php comments_popup_link( false, false, false, 'entry__comments-link' ) ?>
			</div>
		</header>

		<div class="entry__summary">
			<?php the_excerpt() ?>
		</div>

	<?php endif ?>

</article>
