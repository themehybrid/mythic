<article <?php Hybrid\Attr\render( 'entry' ) ?>>

	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title() ?></h1>
	</header>

	<?php Hybrid\MediaGrabber\render( [ 'type' => 'audio' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
	</div>

	<div class="media-meta media-meta--audio">

		<h3 class="media-meta__title"><?php esc_html_e( 'Audio Info' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\MediaMeta\render( 'length_formatted', [ 'itemtag' => 'li', 'label' => __( 'Run Time' )     ] ) ?>
			<?php Hybrid\MediaMeta\render( 'artist',           [ 'itemtag' => 'li', 'label' => __( 'Artist' )       ] ) ?>
			<?php Hybrid\MediaMeta\render( 'album',            [ 'itemtag' => 'li', 'label' => __( 'Album' )        ] ) ?>
			<?php Hybrid\MediaMeta\render( 'track_number',     [ 'itemtag' => 'li', 'label' => __( 'Track Number' ) ] ) ?>
			<?php Hybrid\MediaMeta\render( 'year',             [ 'itemtag' => 'li', 'label' => __( 'Year' )         ] ) ?>
			<?php Hybrid\MediaMeta\render( 'genre',            [ 'itemtag' => 'li', 'label' => __( 'Genre' )        ] ) ?>
			<?php Hybrid\MediaMeta\render( 'file_name',        [ 'itemtag' => 'li', 'label' => __( 'Name' )         ] ) ?>
			<?php Hybrid\MediaMeta\render( 'mime_type',        [ 'itemtag' => 'li', 'label' => __( 'Mime Type' )    ] ) ?>
			<?php Hybrid\MediaMeta\render( 'file_type',        [ 'itemtag' => 'li', 'label' => __( 'Type' )         ] ) ?>
			<?php Hybrid\MediaMeta\render( 'file_size',        [ 'itemtag' => 'li', 'label' => __( 'Size' )         ] ) ?>
		</ul>

	</div>

</article>
