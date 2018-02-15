<?php $view->layout( 'entry/layout' ) ?>

<?php $view->start( 'entry-header' ); ?>

	<header class="entry__header">
		<h1 class="entry__title"><?php the_title(); ?></h1>
	</header>

<?php $view->stop(); ?>

<?php $view->start( 'entry-content' ); ?>

	<div class="entry__content">
		<?php the_excerpt(); ?>
	</div>

<?php $view->stop(); ?>
