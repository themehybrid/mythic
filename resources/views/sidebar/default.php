<?php if ( is_active_sidebar( $data->name ) ) : ?>

	<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?>">

		<h3 class="sidebar__title screen-reader-text"><?= hybrid_get_sidebar_name( $data->name ) ?></h3>

		<?php dynamic_sidebar( $data->name ) ?>

	</aside>

<?php endif ?>
