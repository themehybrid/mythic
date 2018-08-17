<li <?php Hybrid\Attr\display( 'comment' ) ?>>

	<header class="comment__meta">
		<?php echo get_avatar( $data->comment, $data->args['avatar_size'], '', '', [ 'class' => 'comment__avatar' ] ) ?>

		<?php Hybrid\Comment\display_author( [ 'after' => '<br />' ] ) ?>
		<?php Hybrid\Comment\display_permalink( [
			'text' => sprintf(
				// Translators: 1 is the comment date and 2 is the time.
				esc_html__( '%1$s at %2$s' ),
				Hybrid\Comment\render_date(),
				Hybrid\Comment\render_time()
			)
		] ) ?>
		<?php Hybrid\Comment\display_edit_link( [ 'before' => Mythic\sep() ] ) ?>
		<?php Hybrid\Comment\display_reply_link( [ 'before' => Mythic\sep() ] ) ?>
	</header>

	<div class="comment__content">

		<?php if ( ! Hybrid\Comment\is_approved() ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
