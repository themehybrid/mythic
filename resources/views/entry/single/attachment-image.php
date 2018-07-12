<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title() ?></h1>

		<div class="entry__byline">
			<?php Hybrid\Media\render_image_sizes( [ 'text' => esc_html__( 'Sizes: %s' ) ] ) ?>
		</div>
	</header>

	<?php echo wp_get_attachment_image( get_the_ID(), 'large', false, [ 'class' => 'aligncenter' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
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
			<h3 class="media-gallery__title"><?php esc_html_e( 'Gallery' ) ?></h3>
			<?php echo $gallery ?>
		</div>

	<?php endif ?>

	<div class="media-meta media-meta--image">

		<h3 class="media-meta__title"><?php esc_html_e( 'Image Info' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\MediaMeta\render( 'dimensions',        [ 'itemtag' => 'li', 'label' => __( 'Dimensions' )    ] ) ?>
			<?php Hybrid\MediaMeta\render( 'created_timestamp', [ 'itemtag' => 'li', 'label' => __( 'Date' )          ] ) ?>
			<?php Hybrid\MediaMeta\render( 'camera',            [ 'itemtag' => 'li', 'label' => __( 'Camera' )        ] ) ?>
			<?php Hybrid\MediaMeta\render( 'aperture',          [ 'itemtag' => 'li', 'label' => __( 'Aperture' )      ] ) ?>
			<?php Hybrid\MediaMeta\render( 'focal_length',      [ 'itemtag' => 'li', 'label' => __( 'Focal Length' )  ] ) ?>
			<?php Hybrid\MediaMeta\render( 'iso',               [ 'itemtag' => 'li', 'label' => __( 'ISO' )           ] ) ?>
			<?php Hybrid\MediaMeta\render( 'shutter_speed',     [ 'itemtag' => 'li', 'label' => __( 'Shutter Speed' ) ] ) ?>
			<?php Hybrid\MediaMeta\render( 'file_name',         [ 'itemtag' => 'li', 'label' => __( 'Name' )          ] ) ?>
			<?php Hybrid\MediaMeta\render( 'mime_type',         [ 'itemtag' => 'li', 'label' => __( 'Mime Type' )     ] ) ?>
			<?php Hybrid\MediaMeta\render( 'file_type',         [ 'itemtag' => 'li', 'label' => __( 'Type' )          ] ) ?>
			<?php Hybrid\MediaMeta\render( 'file_size',         [ 'itemtag' => 'li', 'label' => __( 'Size' )          ] ) ?>
		</ul>

	</div>

</article>
