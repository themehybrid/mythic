<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : ?>

	<nav class="comments-nav" role="navigation">

		<h3 class="comments-nav__title screen-reader-text"><?php esc_html_e( 'Comments Navigation' ) ?></h3>

		<?php previous_comments_link(
			sprintf( '<span class="screen-reader-text">%s</span>', _x( '&larr; Previous', 'comments navigation' ) )
		) ?>

		<span class="page-numbers"><?php printf(
			// Translators: Comments page numbers. 1 is current page and 2 is total pages.
			__( 'Page %1$s of %2$s' ),
			get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1,
			get_comment_pages_count()
		) ?></span>

		<?php next_comments_link(
			sprintf( '<span class="screen-reader-text">%s</span>', _x( 'Next &rarr;', 'comments navigation' ) )
		) ?>

	</nav>

<?php endif ?>
