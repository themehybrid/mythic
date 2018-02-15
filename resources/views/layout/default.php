<html>
<head>
<?php wp_head(); ?>
</head>
<body>

<header>
	<?php $view->insert( 'menu/default', [ 'name' => 'primary' ] ); ?>
</header>

<?= $view->section( 'content' ) ?>

<?php wp_footer(); ?>
</body>
</html>
