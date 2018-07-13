<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title() ?></h1>
	</header>

	<?php Hybrid\Media\render( [ 'type' => 'video' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
	</div>

	<div class="media-meta media-meta--video">

		<h3 class="media-meta__title"><?php esc_html_e( 'Video Info' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\render_meta( 'length_formatted', [ 'tag' => 'li', 'label' => __( 'Run Time' )   ] ) ?>
			<?php Hybrid\Media\render_meta( 'dimensions',       [ 'tag' => 'li', 'label' => __( 'Dimensions' ) ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_name',        [ 'tag' => 'li', 'label' => __( 'Name' )       ] ) ?>
			<?php Hybrid\Media\render_meta( 'mime_type',        [ 'tag' => 'li', 'label' => __( 'Mime Type' )  ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_type',        [ 'tag' => 'li', 'label' => __( 'Type' )       ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_size',        [ 'tag' => 'li', 'label' => __( 'Size' )       ] ) ?>
		</ul>

	</div>

</article>
