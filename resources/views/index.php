<?php $view->layout( 'layout/default' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php $view->insert( 'entry/post' ); ?>

<?php endwhile; endif; ?>
