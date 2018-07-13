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
			<?php Hybrid\Media\render_meta( 'dimensions',        [ 'tag' => 'li', 'label' => __( 'Dimensions' )    ] ) ?>
			<?php Hybrid\Media\render_meta( 'created_timestamp', [ 'tag' => 'li', 'label' => __( 'Date' )          ] ) ?>
			<?php Hybrid\Media\render_meta( 'camera',            [ 'tag' => 'li', 'label' => __( 'Camera' )        ] ) ?>
			<?php Hybrid\Media\render_meta( 'aperture',          [ 'tag' => 'li', 'label' => __( 'Aperture' )      ] ) ?>
			<?php Hybrid\Media\render_meta( 'focal_length',      [ 'tag' => 'li', 'label' => __( 'Focal Length' )  ] ) ?>
			<?php Hybrid\Media\render_meta( 'iso',               [ 'tag' => 'li', 'label' => __( 'ISO' )           ] ) ?>
			<?php Hybrid\Media\render_meta( 'shutter_speed',     [ 'tag' => 'li', 'label' => __( 'Shutter Speed' ) ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_name',         [ 'tag' => 'li', 'label' => __( 'Name' )          ] ) ?>
			<?php Hybrid\Media\render_meta( 'mime_type',         [ 'tag' => 'li', 'label' => __( 'Mime Type' )     ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_type',         [ 'tag' => 'li', 'label' => __( 'Type' )          ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_size',         [ 'tag' => 'li', 'label' => __( 'Size' )          ] ) ?>
		</ul>

	</div>

</article>
