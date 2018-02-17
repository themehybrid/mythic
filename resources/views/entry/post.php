<?php $view->layout( 'entry/layout' ) ?>

<?php $view->start( 'entry-header' ); ?>

	<?php if ( is_singular() ) : ?>
		<h1 class="entry__title"><?php single_post_title(); ?></h1>
	<?php else : ?>
		<h2 class="entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
	<?php endif; ?>

	<div class="entry__byline">
		<?php hybrid_post_author( array( 'wrap' => '<span class="entry__author">%2$s</span>' ) ); ?>
		<span class="sep"><?php _ex( '&middot;', 'meta separator' ); ?></span>
		<time class="entry__published"><?php echo get_the_date(); ?></time>
		<span class="sep"><?php _ex( '&middot;', 'meta separator' ); ?></span>
		<?php comments_popup_link( false, false, false, 'entry__comments-link' ); ?>
	</div>

<?php $view->stop(); ?>

<?php $view->start( 'entry-content' ); ?>

	<div class="entry__content">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>

<?php $view->stop(); ?>

<?php $view->start( 'entry-footer' ); ?>

	<footer class="entry__foooter">
		<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
		<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag' ) ); ?>
	</footer>

<?php $view->stop(); ?>
