<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title() ?>

		<div class="entry__byline">
			<?php Mythic\display_image_sizes( [
				// Translators: %s is a list of image size links.
				'text' => esc_html__( 'Sizes: %s', 'mythic' )
			] ) ?>
		</div>
	</header>

	<?php echo wp_get_attachment_image( get_the_ID(), 'large', false, [ 'class' => 'aligncenter' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

	<?php $gallery = gallery_shortcode( [
		'columns'     => 4,
		'numberposts' => 8,
		'orderby'     => 'rand',
		'id'          => get_queried_object()->post_parent,
		'exclude'     => get_the_ID()
	] ) ?>

	<?php if ( $gallery ) : ?>

		<div class="media-gallery">
			<h3 class="media-gallery__title"><?php esc_html_e( 'Gallery', 'mythic' ) ?></h3>
			<?php echo $gallery // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>

	<?php endif ?>

	<div class="media-meta media-meta--image">

		<h3 class="media-meta__title"><?php esc_html_e( 'Image Info', 'mythic' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\Meta\display( 'dimensions',        [ 'tag' => 'li', 'label' => __( 'Dimensions', 'mythic' )    ] ) ?>
			<?php Hybrid\Media\Meta\display( 'created_timestamp', [ 'tag' => 'li', 'label' => __( 'Date', 'mythic' )          ] ) ?>
			<?php Hybrid\Media\Meta\display( 'camera',            [ 'tag' => 'li', 'label' => __( 'Camera', 'mythic' )        ] ) ?>
			<?php Hybrid\Media\Meta\display( 'aperture',          [ 'tag' => 'li', 'label' => __( 'Aperture', 'mythic' )      ] ) ?>
			<?php Hybrid\Media\Meta\display( 'focal_length',      [ 'tag' => 'li', 'label' => __( 'Focal Length', 'mythic' )  ] ) ?>
			<?php Hybrid\Media\Meta\display( 'iso',               [ 'tag' => 'li', 'label' => __( 'ISO', 'mythic' )           ] ) ?>
			<?php Hybrid\Media\Meta\display( 'shutter_speed',     [ 'tag' => 'li', 'label' => __( 'Shutter Speed', 'mythic' ) ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_name',         [ 'tag' => 'li', 'label' => __( 'Name', 'mythic' )          ] ) ?>
			<?php Hybrid\Media\Meta\display( 'mime_type',         [ 'tag' => 'li', 'label' => __( 'Mime Type', 'mythic' )     ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_type',         [ 'tag' => 'li', 'label' => __( 'Type', 'mythic' )          ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_size',         [ 'tag' => 'li', 'label' => __( 'Size', 'mythic' )          ] ) ?>
		</ul>

	</div>

</article>
