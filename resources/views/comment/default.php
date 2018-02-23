<?php namespace ABC; ?>

<li <?php hybrid_attr( 'comment' ); ?>>

	<header class="thread__meta">
		<?= get_avatar( $data->comment, 96, '', '', [ 'class' => 'thread__avatar' ] ) ?>

		<span class="thread__author"><?php comment_author_link() ?></span>
		<br />
		<a href="<?php comment_link() ?>" class="comment__permalink"><time class="comment__published"><?php printf( __( '%s ago' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ?></time></a>
		<?php edit_comment_link( null, get_meta_sep() ) ?>
		<?php hybrid_comment_reply_link( array( 'before' => get_meta_sep() ) ) ?>
	</header>

	<div class="thread__content">
		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
