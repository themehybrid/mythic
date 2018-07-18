<li <?php Hybrid\Attr\render( 'comment' ) ?>>

	<div class="comment__meta">
		<span class="comment__author"><?php comment_author_link() ?></span><br />
		<a href="<?php comment_link() ?>" class="comment__permalink"><time class="comment__published"><?php printf( __( '%s ago' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ?></time></a>
		<?php edit_comment_link( null, Mythic\sep() ) ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
