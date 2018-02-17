<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

<div class="site">

	<header class="site-header">

		<div class="site-header__branding">
			<h1 class="site-header__title"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="site-header__description"><?php bloginfo( 'description' ); ?></div>
		</div>

		<?php $view->insert( 'menu/default', [ 'name' => 'primary' ] ); ?>
	</header>

	<div class="site__body">

		<main class="site__content">
			<?= $view->section( 'content' ) ?>
		</main>

		<?php $view->insert( 'sidebar/default', [ 'name' => 'primary'] ); ?>

	</div>

	<footer class="site-footer">

		<p class="site-footer__credit">
			<?php printf(
				// Translators: 1 is WordPress name/link.
				esc_html__( 'Powered by crazy ideas and %s.' ), hybrid_get_wp_link()
			); ?>
		</p>

	</footer>

	<?php wp_footer(); ?>
</body>
</html>
