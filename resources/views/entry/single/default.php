<article <?php Hybrid\attr( 'entry' ) ?>>

	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title() ?></h1>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\render_view( 'partials', 'pagination-singular' ) ?>
	</div>

</article>
