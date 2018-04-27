<?php if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) ) {
	return;
} ?>

<section class="comments-template">

	<div id="comments" class="comments">

		<?php if ( have_comments() ) : ?>

			<h2 class="comments__title"><?php comments_number() ?></h2>

			<?php Hybrid\render_view( 'partials', 'comments-nav' ) ?>

			<ol class="comments__list">

				<?php wp_list_comments( [
					'style'        => 'ol',
					'callback'     => function( $comment, $args, $depth ) {
						Hybrid\render_view( 'comment', Hybrid\get_comment_hierarchy(), compact( 'comment', 'args', 'depth' ) );
					},
					'end-callback' => function() {
						echo '</li>';
					}
				] ) ?>

			</ol>

		<?php endif ?>

		<?php if ( ! comments_open() ) : ?>

			<p class="comments__closed">
				<?php esc_html_e( 'Comments are closed.' ) ?>
			</p>

		<?php endif ?>

	</div>

	<?php comment_form() ?>

</section>
