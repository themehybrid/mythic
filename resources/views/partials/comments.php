<?php if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) ) {
	return;
} ?>

<section id="comments" class="comments-template">

	<?php if ( have_comments() ) : ?>

		<div class="thread thread--comments">

			<h2 id="comments-number" class="thread__title"><?php comments_number() ?></h2>

			<?php Hybrid\render_view( 'partials', 'comments-nav' ) ?>

			<ol class="thread__items">

				<?php wp_list_comments( [
					'style'        => 'ol',
					'callback'     => function( $comment ) {
						Hybrid\render_view( 'comment', [ get_comment_type( $comment ) ], [ 'comment' => $comment ] );
					},
					'end-callback' => 'Hybrid\comments_end_callback'
				] ) ?>

			</ol>

		</div>

	<?php endif ?>

	<?php if ( ! comments_open() ) : ?>

		<p class="comments-closed">
			<?php esc_html_e( 'Comments are closed.' ) ?>
		</p>

	<?php endif ?>

	<?php comment_form() ?>

</section>
