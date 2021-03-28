<?php if ( is_active_sidebar( $data->sidebar ) ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $data->sidebar ) ?>>

		<h3 class="sidebar__title screen-reader-text">
			<?php Hybrid\Theme\Sidebar\display_name( $data->sidebar ) ?>
		</h3>

		<?php dynamic_sidebar( $data->sidebar ) ?>

	</aside>

<?php endif ?>
