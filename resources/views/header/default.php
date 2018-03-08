<!DOCTYPE html>
<html <?php language_attributes( 'html' ) ?>>

<head>
<?php wp_head() ?>
</head>

<body <?php hybrid_attr( 'body' ) ?>>

<div class="app">

	<header class="app-header">

		<div class="app-header__branding">
			<h1 class="app-header__title"><a href="<?= esc_url( home_url() ) ?>"><?php bloginfo( 'name' ) ?></a></h1>
			<div class="app-header__description"><?php bloginfo( 'description' ) ?></div>
		</div>

		<?php ABC\render_view( 'menu', 'primary', [ 'name' => 'primary' ] ) ?>

	</header>

	<div class="app-content">
