<!DOCTYPE html>
<html <?php Hybrid\Attr\display( 'html' ) ?>>

<head>
<?php wp_head() ?>
</head>

<body <?php Hybrid\Attr\display( 'body' ) ?>>

<div class="app">

	<header class="app-header">

		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content' ) ?></a>

		<div class="app-header__branding">
			<?php the_custom_logo() ?>
			<?php Hybrid\Site\display_title() ?>
			<?php Hybrid\Site\display_description() ?>
		</div>

		<?php the_custom_header_markup() ?>

		<?php Hybrid\View\display( 'nav/menu', 'primary', [ 'location' => 'primary' ] ) ?>

	</header>
