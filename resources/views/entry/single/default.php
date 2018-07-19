<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Post\render_title() ?>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
	</div>

</article>
