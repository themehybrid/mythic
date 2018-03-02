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
	 * @access public
	 * @var    array
	 */
	private $items = [];

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $args
	 * @return void
	 */
	public function __construct( $args = [] ) {

		$this->args = (array) $args;
	}

	/**
	 * Sets up the array of items.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object  $wp_query
	 * @global object  $wp_rewrite
	 * @return void
	 */
	public function get_items() {
		global $wp_query, $wp_rewrite;

		// Build URL base.
		$base      = html_entity_decode( get_pagenum_link() );
		$url_parts = explode( '?', $base );

		$base = trailingslashit( $url_parts[0] ) . '%_%';

		// Build format.
		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $base, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Get default total and current parameters.
		$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
		$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		// Set default arguments.
		$defaults = [
			'base'               => $base,
			'format'             => $format,
			'total'              => $total,
			'current'            => $current,
			'aria_current'       => 'page',
			'show_all'           => false,
			'prev_next'          => true,
			'prev_text'          => __( 'Previous' ),
			'next_text'          => __( 'Next' ),
			'end_size'           => 1,
			'mid_size'           => 2,
			'type'               => 'plain',
			'add_args'           => [],
			'add_fragment'       => '',
			'before_page_number' => '',
			'after_page_number'  => '',

			// Wrapping HTML.
			'container_tag'   => 'nav',
			'container_class' => 'pagination pagination--posts',
			'list_tag'        => 'ul',
			'list_class'      => 'pagination__items',
			'item_tag'        => 'li',
			'item_class'      => 'pagination__item pagination__item--%s',
			'anchor_class'    => 'pagination__anchor pagination__anchor--%s'
		];

		$this->args = wp_parse_args( $this->args, $defaults );

		// Make sure our query args is actually an array.
		if ( ! is_array( $this->args['add_args'] ) ) {

			$this->args['add_args'] = [];
		}

		// Get some arguments and make sure they're the right type.
		$total    = (int) $this->args['total'];
		$current  = (int) $this->args['current'];
		$dots     = false;
		$end_size = 1 > $this->args['end_size'] ? 1 : (int) $this->args['end_size'];
		$mid_size = 0 > $this->args['mid_size'] ? 2 : (int) $this->args['mid_size'];

		// Bail if the total is less than 2 pages.
		if ( $total < 2 ) {
			return;
		}

		// Merge additional query vars found in the original URL into 'add_args' array.
		if ( isset( $url_parts[1] ) ) {

			// Find the format argument.
			$format       = explode( '?', str_replace( '%_%', $this->args['format'], $this->args['base'] ) );
			$format_query = isset( $format[1] ) ? $format[1] : '';
			wp_parse_str( $format_query, $format_args );

			// Find the query args of the requested URL.
			wp_parse_str( $url_parts[1], $url_query_args );

			// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
			foreach ( $format_args as $format_arg => $format_arg_value ) {

				unset( $url_query_args[ $format_arg ] );
			}

			$this->args['add_args'] = array_merge( $this->args['add_args'], urlencode_deep( $url_query_args ) );
		}

		// Previous navigation item.
		if ( $this->args['prev_next'] && $current && 1 < $current ) {

			$this->items[] = [
				'href' => $this->format_url( 2 == $current ? '' : $this->args['format'], $current - 1 ),
				'type' => 'prev',
				'text' => $this->args['prev_text']
			];
		}

		// Loop through each of the pages.
		for ( $n = 1; $n <= $total; $n++ ) {

			// If the number is for the current page.
			if ( $n == $current ) {

				$this->items[] = [
					'type' => 'current',
					'text' => $this->format_number( $n )
				];

				$dots = true;

			// If the number is not for the current page.
			} else {

				// Linked page number.
				if ( $this->args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) {

					$this->items[] = [
						'href' => $this->format_url( 1 == $n ? '' : $this->args['format'], $n ),
						'type' => 'number',
						'text' => $this->format_number( $n )
					];

					$dots = true;

				// Dots.
				} elseif ( $dots && ! $this->args['show_all'] ) {

					$this->items[] = [
						'type' => 'dots',
						'text' => __( '&hellip;' )
					];

					$dots = false;
				}
			}
		}

		// Next navigation item.
		if ( $this->args['prev_next'] && $current && $current < $total ) {

			$this->items[] = [
				'href' => $this->format_url( $this->args['format'], $current + 1 ),
				'type' => 'next',
				'text' => $this->args['next_text']
			];
		}
	}

	/**
	 * Formats a number's output.
	 *
	 * @since  1.0.0
	 * @access private
	 * @param  int    $n
	 * @return string
	 */
	private function format_number( $n ) {

		return $this->args['before_page_number'] . number_format_i18n( $n ) . $this->args['after_page_number'];
	}

	/**
	 * Format a pagination URL.
	 *
	 * @since  1.0.0
	 * @access private
	 * @param  string  $replace_format
	 * @param  string  $replace_num
	 * @return string
	 */
	private function format_url( $replace_format, $replace_num ) {

		$url = str_replace( '%_%', $replace_format, $this->args['base'] );

		$url = str_replace( '%#%', $replace_num, $url );

		if ( $this->args['add_args'] ) {

			$url = add_query_arg( $this->args['add_args'], $url );
		}

		$url .= $this->args['add_fragment'];

		return apply_filters( 'paginate_links', $url );
	}

	/**
	 * Render the pagination output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function fetch() {

		$this->get_items();

		$out = '';

		foreach ( $this->items as $item ) {

			$out .= $this->format_item( $item );
		}

		// Format list.
		$out = sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $this->args['list_tag'] ),
			esc_attr( $this->args['list_class'] ),
			$out
		);

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
			esc_html__( 'Posts navigation' ),
			$out
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
