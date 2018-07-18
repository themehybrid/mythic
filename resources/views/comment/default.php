<li <?php Hybrid\Attr\render( 'comment' ) ?>>

	<header class="comment__meta">
		<?php echo get_avatar( $data->comment, $data->args['avatar_size'], '', '', [ 'class' => 'comment__avatar' ] ) ?>

		<span class="comment__author"><?php comment_author_link() ?></span>
		<br />
		<a href="<?php comment_link() ?>" class="comment__permalink"><time class="comment__published"><?php printf( __( '%s ago' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ?></time></a>
		<?php edit_comment_link( null, Mythic\get_meta_sep() ) ?>
		<?php Hybrid\Comment\render_reply_link( [ 'before' => Mythic\get_meta_sep() ] ) ?>
	</header>

	<div class="comment__content">

		<?php if ( '0' == $data->comment->comment_approved ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
