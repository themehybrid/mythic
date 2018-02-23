<?php
namespace ABC;

if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) )
	return;
?>

<section id="comments" class="comments-template">

	<?php if ( have_comments() ) : ?>

		<div class="thread thread--comments">

			<h2 id="comments-number" class="thread__title"><?php comments_number() ?></h2>

			<?php render_view( 'partials', 'comments-nav' ) ?>

			<ol class="thread__items">

				<?php wp_list_comments( [
					'style'        => 'ol',
					'callback'     => function( $comment ) {
						render_view( 'comment', [ get_comment_type( $comment ) ], [ 'comment' => $comment ] );
					},
					'end-callback' => 'hybrid_comments_end_callback'
				] ) ?>

			</ol>

		</div>

	<?php endif ?>

	<?php render_view( 'partials', 'comments-error' ) ?>

	<?php comment_form( [
		'class_form'   => 'comment-form',
		'class_submit' => 'comment-form__submit'
	] ) ?>

</section>
