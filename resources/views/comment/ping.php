<li <?php Hybrid\Attr\display( 'comment' ) ?>>

	<div class="comment__meta">
		<?php Hybrid\Theme\Comment\display_author( [ 'after' => '<br />' ] ) ?>
		<?php Hybrid\Theme\Comment\display_permalink( [
			'text' => sprintf(
				// Translators: 1 is the comment date and 2 is the time.
				esc_html__( '%1$s at %2$s' ),
				Hybrid\Theme\Comment\render_date(),
				Hybrid\Theme\Comment\render_time()
			)
		] ) ?>
		<?php Hybrid\Theme\Comment\display_edit_link( [ 'before' => Mythic\sep() ] ) ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
