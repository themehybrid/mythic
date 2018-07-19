<li <?php Hybrid\Attr\render( 'comment' ) ?>>

	<div class="comment__meta">
		<?php Hybrid\Comment\render_author( [ 'after' => '<br />' ] ) ?>
		<?php Hybrid\Comment\render_permalink( [
			'text' => sprintf(
				// Translators: 1 is the comment date and 2 is the time.
				esc_html__( '%1$s at %2$s' ),
				Hybrid\Comment\fetch_date(),
				Hybrid\Comment\fetch_time()
			)
		] ) ?>
		<?php Hybrid\Comment\render_edit_link( [ 'before' => Mythic\sep() ] ) ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
