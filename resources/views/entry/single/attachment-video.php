<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title() ?>
	</header>

	<?php Hybrid\Media\Grabber\display( [ 'type' => 'video' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--video">

		<h3 class="media-meta__title"><?php esc_html_e( 'Video Info' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\Meta\display( 'length_formatted', [ 'tag' => 'li', 'label' => __( 'Run Time' )   ] ) ?>
			<?php Hybrid\Media\Meta\display( 'dimensions',       [ 'tag' => 'li', 'label' => __( 'Dimensions' ) ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_name',        [ 'tag' => 'li', 'label' => __( 'Name' )       ] ) ?>
			<?php Hybrid\Media\Meta\display( 'mime_type',        [ 'tag' => 'li', 'label' => __( 'Mime Type' )  ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_type',        [ 'tag' => 'li', 'label' => __( 'Type' )       ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_size',        [ 'tag' => 'li', 'label' => __( 'Size' )       ] ) ?>
		</ul>

	</div>

</article>
