<?php if ( pings_open() && ! comments_open() ) : ?>

	<p class="comments-closed pings-open">
		<?php printf(
			// Translators: The two placeholders for HTML. The order can't be changed.
			esc_html__( 'Comments are closed, but %strackbacks%s and pingbacks are open.' ),
			sprintf( '<a href="%s">', esc_url( get_trackback_url() ) ),
			'</a>'
		) ?>
	</p>

<?php elseif ( ! comments_open() ) : ?>

	<p class="comments-closed">
		<?php esc_html_e( 'Comments are closed.' ) ?>
	</p>

<?php endif ?>
