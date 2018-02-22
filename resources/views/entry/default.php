<article class="entry">

	<?php if ( is_singular( get_the_ID() ) ) : ?>

		<header class="entry__header">
			<h1 class="entry__title"><?php single_post_title() ?></h1>
		</header>

		<div class="entry__content">
			<?php the_content() ?>
			<?php wp_link_pages() ?>
		</div>

	<?php else : ?>

		<header class="entry__header">
			<h2 class="entry__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></h2>
		</header>

		<div class="entry__summary">
			<?php the_excerpt() ?>
		</div>

	<?php endif ?>

</article>
