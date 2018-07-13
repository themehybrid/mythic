<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title() ?></h1>
	</header>

	<?php Hybrid\Media\render( [ 'type' => 'audio' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
	</div>

	<div class="media-meta media-meta--audio">

		<h3 class="media-meta__title"><?php esc_html_e( 'Audio Info' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\render_meta( 'length_formatted', [ 'tag' => 'li', 'label' => __( 'Run Time' )     ] ) ?>
			<?php Hybrid\Media\render_meta( 'artist',           [ 'tag' => 'li', 'label' => __( 'Artist' )       ] ) ?>
			<?php Hybrid\Media\render_meta( 'album',            [ 'tag' => 'li', 'label' => __( 'Album' )        ] ) ?>
			<?php Hybrid\Media\render_meta( 'track_number',     [ 'tag' => 'li', 'label' => __( 'Track Number' ) ] ) ?>
			<?php Hybrid\Media\render_meta( 'year',             [ 'tag' => 'li', 'label' => __( 'Year' )         ] ) ?>
			<?php Hybrid\Media\render_meta( 'genre',            [ 'tag' => 'li', 'label' => __( 'Genre' )        ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_name',        [ 'tag' => 'li', 'label' => __( 'Name' )         ] ) ?>
			<?php Hybrid\Media\render_meta( 'mime_type',        [ 'tag' => 'li', 'label' => __( 'Mime Type' )    ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_type',        [ 'tag' => 'li', 'label' => __( 'Type' )         ] ) ?>
			<?php Hybrid\Media\render_meta( 'file_size',        [ 'tag' => 'li', 'label' => __( 'Size' )         ] ) ?>
		</ul>

	</div>

</article>
