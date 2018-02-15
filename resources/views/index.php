<?php $view->layout( 'layout/default' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php //if ( $this->exists( 'entry/post' ) ) echo 'yes'; ?>

	<?php $view->insert( 'entry/post' ); ?>

<?php endwhile; endif; ?>
