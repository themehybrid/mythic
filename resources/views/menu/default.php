<?php if ( has_nav_menu( $data->name ) ) : ?>

	<nav <?php hybrid_attr( 'menu', $data->name, array( 'class' => 'menu menu--primary' ) ) ?>>

		<h3 class="menu__title"><?= hybrid_get_menu_name( $data->name ) ?></h3>

		<?php wp_nav_menu( [
			'theme_location'  => $data->name,
			'container'       => '',
			'menu_id'         => '',
			'menu_class'      => 'menu__items',
			'link_before'     => '<span class="menu__anchor-text">',
			'link_after'      => '</span>',
			'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'    => 'discard'
		] ); ?>

	</nav>

<?php endif ?>
