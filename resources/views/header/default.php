<!DOCTYPE html>
<html <?php Hybrid\Attr\render( 'html' ) ?>>

<head>
<?php wp_head() ?>
</head>

<body <?php Hybrid\Attr\render( 'body' ) ?>>

<div class="app">

	<header class="app-header">

		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content' ) ?></a>

		<div class="app-header__branding">
			<?php Hybrid\Site\render_title() ?>
			<?php Hybrid\Site\render_description() ?>
		</div>

		<?php Hybrid\View\render( 'menu', 'primary', [ 'name' => 'primary' ] ) ?>

	</header>
