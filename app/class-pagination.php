<?php
/**
 * Fork of the `paginate_links()` function in core WP.
 */

namespace ABC;

class Pagination {

	/**
	 * Array of items in the pagination list.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    array
	 */
	private $items = [];

	/**
	 * Array of arguments that will be passed to `paginate_links()`.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    array
	 */
	private $args = [];

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $args
	 * @return void
	 */
	public function __construct( $args = [] ) {

		$this->args = (array) $args + [
			'mid_size'           => 1,
			'screen_reader_text' => '',
			'container_tag'      => 'nav',
			'container_class'    => 'pagination pagination--posts',
			'list_tag'           => 'ul',
			'list_class'         => 'pagination__items',
			'item_tag'           => 'li',
			'item_class'         => 'pagination__item pagination__item--%s',
			'anchor_class'       => 'pagination__anchor pagination__anchor--%s'
		];

		// Always want an array type so that we can build our own output.
		$this->args['type'] = 'array';
	}

	/**
	 * Sets up the array of items.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function get_items() {

		$links = paginate_links( $this->args );

		foreach ( $links as $link ) {

			$item = [ 'type' => 'number' ];

			// Capture the element attributes and text.
			preg_match( "/<(?:a|span)(.+?)>(.+?)<\/(?:a|span)>/i", $link, $matches );

			if ( ! empty( $matches ) && isset( $matches[1] ) && isset( $matches[2] ) ) {

				// Get an array of the attributes.
				$attr = wp_kses_hair( trim( $matches[1] ), array( 'http', 'https' ) );

				if ( ! empty( $attr['class'] ) ) {

					$intersection = array_intersect(
						[ 'prev', 'next', 'current', 'dots' ],
						explode( ' ', $attr['class']['value'] )
					);

					if ( $intersection ) {

						$item['type'] = reset( $intersection );
					}
				}

				// If there's an HREF attribute, it means we have a link.
				if ( ! empty( $attr['href'] ) ) {

					$item['href'] = esc_url( $attr['href']['value'] );
				}

				$item['text'] = esc_html( $matches[2] );
			}

			$this->items[] = $item;
		}
	}

	/**
	 * Return the pagination output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	 public function fetch() {

		$this->get_items();

		$html = '';

		foreach ( $this->items as $item ) {

			$html .= $this->format_item( $item );
		}

		// Format list.
		$html = sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $this->args['list_tag'] ),
			esc_attr( $this->args['list_class'] ),
			$html
		);

		return $this->navigation_markup( $html );
	}

	/**
	 * Compatibility layer for the core WP `_navigation_markup()` function,
	 * which is marked as private and not for theme/plugin use. So, we're
	 * just rolling our own.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $links
	 * @return string
	 */
	private function navigation_markup( $links ) {

		// Set up template.
		$template = sprintf(
			'<%1$s class="%2$s" role="navigation"><h2 class="screen-reader-text">%3$s</h2>%4$s</%1$s>',
			tag_escape( $this->args['container_tag'] ),
			'%1$s',
			'%2$s',
			'%3$s'
		);

		// Compat with WP's `navigation_markup_template` filter hook.
		$template = apply_filters( 'navigation_markup_template', $template, $this->args['container_class'] );

		return sprintf(
			$template,
			esc_attr( $this->args['container_class'] ),
			$this->args['screen_reader_text'] ? esc_html( $this->args['screen_reader_text'] ) : esc_html__( 'Posts navigation' ),
			$links
		);
	}

	/**
	 * Format an item's HTML output.
	 *
	 * @since  1.0.0
	 * @access private
	 * @param  array   $item
	 * @return string
	 */
	private function format_item( $item ) {

		$tag = isset( $item['href'] ) ? 'a' : 'span';

		if ( isset( $item['href'] ) ) {

			$anchor = sprintf(
				'<a href="%s" class="%s">%s</a>',
				esc_url( $item['href'] ),
				esc_attr( sprintf( $this->args['anchor_class'], 'link' ) ),
				esc_html( $item['text'] )
			);
		} else {
			$anchor = sprintf(
				'<span class="%s">%s</span>',
				esc_attr( sprintf( $this->args['anchor_class'], $item['type'] ) ),
				esc_html( $item['text'] )
			);
		}

		return sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $this->args['item_tag'] ),
			esc_attr( sprintf( $this->args['item_class'], $item['type'] ) ),
			$anchor
		);
	}
}
