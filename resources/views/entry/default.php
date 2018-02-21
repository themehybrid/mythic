<article class="entry">

	<?php if ( is_singular( get_the_ID() ) ) : ?>

		<header class="entry__header">
			<h1 class="entry__title"><?php single_post_title() ?></h1>

			<div class="entry__byline">
				<?php hybrid_post_author( array( 'wrap' => '<span class="entry__author">%2$s</span>' ) ) ?>
				<span class="sep"><?php _ex( '&middot;', 'meta separator' ) ?></span>
				<time class="entry__published"><?php echo get_the_date() ?></time>
				<span class="sep"><?php _ex( '&middot;', 'meta separator' ) ?></span>
				<?php comments_popup_link( false, false, false, 'entry__comments-link' ) ?>
			</div>
		</header>

		<div class="entry__content">
			<?php the_content() ?>
			<?php wp_link_pages() ?>
		</div>

		<footer class="entry__foooter">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ) ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag' ) ) ?>
		</footer>

	<?php else : ?>

		<header class="entry__header">
			<h2 class="entry__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></h2>

			<div class="entry__byline">
				<?php hybrid_post_author( array( 'wrap' => '<span class="entry__author">%2$s</span>' ) ) ?>
				<span class="sep"><?php _ex( '&middot;', 'meta separator' ) ?></span>
				<time class="entry__published"><?php echo get_the_date() ?></time>
				<span class="sep"><?php _ex( '&middot;', 'meta separator' ) ?></span>
				<?php comments_popup_link( false, false, false, 'entry__comments-link' ) ?>
			</div>
		</header>

		<div class="entry__summary">
			<?php the_excerpt() ?>
			<?php wp_link_pages() ?>
		</div>

	<?php endif ?>

</article>
