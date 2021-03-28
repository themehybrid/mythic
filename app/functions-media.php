<?php
/**
 * Media functions.
 *
 * Helper functions and template tags related to media.
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/mythic
 */

namespace Mythic;

/**
 * Outputs the image size links HTML.
 *
 * @since  2.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_image_sizes( array $args = [] ) {
    echo render_image_sizes( $args );
}

/**
 * Returns a set of image attachment links based on size.
 *
 * @since  2.0.0
 * @access public
 * @return string
 */
function render_image_sizes( array $args = [] ) {

    // If not viewing an image attachment page, return.
    if ( ! wp_attachment_is_image( get_the_ID() ) ) {
        return;
    }

    $args = wp_parse_args( $args, [
        'text'       => '%s',
        'sep'        => '/',
        'class'      => 'entry__image-sizes',
        'size_class' => 'entry__image-size-link',
        'before'     => '',
        'after'      => ''
    ] );

    // Set up an empty array for the links.
    $links = [];

    // Get the intermediate image sizes and add the full size to the array.
    $sizes   = get_intermediate_image_sizes();
    $sizes[] = 'full';

    // Loop through each of the image sizes.
    foreach ( $sizes as $size ) {

        // Get the image source, width, height, and whether it's intermediate.
        $image = wp_get_attachment_image_src( get_the_ID(), $size );

        // Add the link to the array if there's an image and if
        // `$is_intermediate` (4th array value) is true or full size.
        if ( ! empty( $image ) && ( true === $image[3] || 'full' == $size ) ) {

            $label = sprintf(
            // Translators: Media dimensions - 1 is width and 2 is height.
                esc_html__( '%1$s &#215; %2$s', 'hybrid-core' ),
                number_format_i18n( absint( $image[1] ) ),
                number_format_i18n( absint( $image[2] ) )
            );

            $links[] = sprintf(
                '<a class="%s" href="%s">%s</a>',
                esc_attr( $args['size_class'] ),
                esc_url( $image[0] ),
                $label
            );
        }
    }

    $sep = $args['sep'] ? sprintf( '<span class="sep">%s</span>', $args['sep'] ) : '';

    $html = sprintf(
        '<span class="%s">%s</span>',
        esc_attr( $args['class'] ),
        sprintf( $args['text'], join( " {$sep} ", $links ) )
    );

    return $args['before'] . $html . $args['after'];
}
