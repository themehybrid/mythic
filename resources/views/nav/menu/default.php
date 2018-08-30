<?php if ( has_nav_menu( $data->location ) ) : ?>

	<nav <?php Hybrid\Attr\display( 'menu', $data->location ) ?>>

		<h3 class="menu__title screen-reader-text">
			<?php Hybrid\Menu\display_name( $data->location ) ?>
		</h3>

		<?php wp_nav_menu( [
			'theme_location' => $data->location,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard'
		] ) ?>

	</nav>

<?php endif ?>
