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

	<?php ABC\render_view( 'menu', [ 'default' ], [ 'name' => 'primary' ] ); ?>

</header>

<div class="site__body">
