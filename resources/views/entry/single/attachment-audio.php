<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title() ?>
	</header>

	<?php Hybrid\Media\Grabber\display( [ 'type' => 'audio' ] ) ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--audio">

		<h3 class="media-meta__title"><?php esc_html_e( 'Audio Info', 'mythic' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\Meta\display( 'length_formatted', [ 'tag' => 'li', 'label' => __( 'Run Time', 'mythic' )     ] ) ?>
			<?php Hybrid\Media\Meta\display( 'artist',           [ 'tag' => 'li', 'label' => __( 'Artist', 'mythic' )       ] ) ?>
			<?php Hybrid\Media\Meta\display( 'album',            [ 'tag' => 'li', 'label' => __( 'Album', 'mythic' )        ] ) ?>
			<?php Hybrid\Media\Meta\display( 'track_number',     [ 'tag' => 'li', 'label' => __( 'Track Number', 'mythic' ) ] ) ?>
			<?php Hybrid\Media\Meta\display( 'year',             [ 'tag' => 'li', 'label' => __( 'Year', 'mythic' )         ] ) ?>
			<?php Hybrid\Media\Meta\display( 'genre',            [ 'tag' => 'li', 'label' => __( 'Genre', 'mythic' )        ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_name',        [ 'tag' => 'li', 'label' => __( 'Name', 'mythic' )         ] ) ?>
			<?php Hybrid\Media\Meta\display( 'mime_type',        [ 'tag' => 'li', 'label' => __( 'Mime Type', 'mythic' )    ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_type',        [ 'tag' => 'li', 'label' => __( 'Type', 'mythic' )         ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_size',        [ 'tag' => 'li', 'label' => __( 'Size', 'mythic' )         ] ) ?>
		</ul>

	</div>

</article>
