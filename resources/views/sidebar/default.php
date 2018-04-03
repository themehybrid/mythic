<?php if ( is_active_sidebar( $data->name ) ) : ?>

	<aside <?php Hybrid\attr( 'sidebar', $data->name ) ?>>

		<h3 class="sidebar__title screen-reader-text"><?= Hybrid\get_sidebar_name( $data->name ) ?></h3>

		<?php dynamic_sidebar( $data->name ) ?>

	</aside>

<?php endif ?>
