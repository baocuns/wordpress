<?php

namespace ShopEngine\Utils;


use ShopEngine\Core\Builders\Action;

defined('ABSPATH') || exit;

/**
 * Global helper class.
 *
 * @since 1.0.0
 */
class Helper {

    public static function is_elementor_active() {

        return did_action('elementor/loaded');
    }

	public static function is_gutenberg_active() {

		return !did_action('elementor/loaded');
	}

    public static function is_elementor_editor_mode() {

        if(self::is_elementor_active()) {

	        return \Elementor\Plugin::$instance->editor->is_edit_mode();
        }

        return false;
    }


	public static function get_elementor_css_uri($pid) {

		global $blog_id;

		$wp_upload_dir = wp_upload_dir(null, false);

		$base = $wp_upload_dir['baseurl'] . '/elementor/css/';

		return set_url_scheme($base . 'post-' . $pid . '.css');
	}

	public static function add_to_url($url, $param) {
		$info = parse_url( $url );
		$query = [];

		if(isset($info['query'])){
			parse_str( $info['query'], $query );
		}
		return $info['scheme'] . '://' . $info['host'] .( $info['path'] ?? '' ). '?' . http_build_query( $query ? array_merge( $query, $param ) : $param );
	}


	/**
	 * Auto generate classname from path.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function make_classname($dirname) {
		$dirname = pathinfo($dirname, PATHINFO_FILENAME);
		$class_name = explode('-', $dirname);
		$class_name = array_map('ucfirst', $class_name);
		$class_name = implode('_', $class_name);

		return $class_name;
	}

	public static function kses($raw) {

		$allowed_tags = [
			'a'                             => [
				'class' => [],
				'href'  => [],
				'rel'   => [],
				'title' => [],
			],
			'abbr'                          => [
				'title' => [],
			],
			'b'                             => [],
			'blockquote'                    => [
				'cite' => [],
			],
			'cite'                          => [
				'title' => [],
			],
			'code'                          => [],
			'del'                           => [
				'datetime' => [],
				'title'    => [],
			],
			'dd'                            => [],
			'div'                           => [
				'class' => [],
				'title' => [],
				'style' => [],
			],
			'dl'                            => [],
			'dt'                            => [],
			'em'                            => [],
			'h1'                            => [
				'class' => [],
			],
			'h2'                            => [
				'class' => [],
			],
			'h3'                            => [
				'class' => [],
			],
			'h4'                            => [
				'class' => [],
			],
			'h5'                            => [
				'class' => [],
			],
			'h6'                            => [
				'class' => [],
			],
			'i'                             => [
				'class' => [],
			],
			'img'                           => [
				'alt'    => [],
				'class'  => [],
				'height' => [],
				'src'    => [],
				'width'  => [],
			],
			'li'                            => [
				'class' => [],
			],
			'ol'                            => [
				'class' => [],
			],
			'p'                             => [
				'class' => [],
			],
			'q'                             => [
				'cite'  => [],
				'title' => [],
			],
			'span'                          => [
				'class' => [],
				'title' => [],
				'style' => [],
			],
			'iframe'                        => [
				'width'       => [],
				'height'      => [],
				'scrolling'   => [],
				'frameborder' => [],
				'allow'       => [],
				'src'         => [],
			],
			'strike'                        => [],
			'br'                            => [],
			'strong'                        => [],
			'data-wow-duration'             => [],
			'data-wow-delay'                => [],
			'data-wallpaper-options'        => [],
			'data-stellar-background-ratio' => [],
			'ul'                            => [
				'class' => [],
			],
		];

		if(function_exists('wp_kses')) { // WP is here
			return wp_kses($raw, $allowed_tags);
		} else {
			return $raw;
		}
	}

	public static function kspan($text) {
		return str_replace(['{', '}'], ['<span>', '</span>'], self::kses($text));
	}

	public static function category_list_by_taxonomy($taxonomy = '') {
		$query_args = [
			'orderby'    => 'ID',
			'order'      => 'DESC',
			'hide_empty' => 1,
			'taxonomy'   => $taxonomy,
		];

		$categories = get_categories($query_args);

		return $categories;
	}

	public static function trim_words($text, $num_words) {
		return wp_trim_words($text, $num_words, '');
	}

	public static function array_push_assoc($array, $key, $value) {
		$array[$key] = $value;

		return $array;
	}

	public static function render($content) {
		if(stripos($content, "shopengine-has-lisence") !== false) {
			return null;
		}

		return $content;
	}

	public static function render_elementor_content($content_id) {
		$elementor_instance = \Elementor\Plugin::instance();

		return $elementor_instance->frontend->get_builder_content_for_display($content_id);
	}

	public static function esc_options($str, $options = [], $default = '') {
		if(!in_array($str, $options)) {
			return $default;
		}

		return $str;
	}

	public static function img_meta($id) {
		$attachment = get_post($id);
		if($attachment == null || $attachment->post_type != 'attachment') {
			return null;
		}

		return [
			'alt'         => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink($attachment->ID),
			'src'         => $attachment->guid,
			'title'       => $attachment->post_title,
		];
	}

	public static function _product_tag_sale_badge($settings = null) {
		global $product;
		$terms = get_the_terms(get_the_ID(), 'product_tag');

		$badge_position = (isset($settings['badge_position']) && !empty($settings['badge_position'])) ? esc_attr($settings['badge_position']) : 'top-right';
		$badge_align = (isset($settings['badge_align']) && !empty($settings['badge_align'])) ? esc_attr($settings['badge_align']) : 'horizontal';

		if($product->is_on_sale() || !empty($terms)) : ?>
            <div class="product-tag-sale-badge position-<?php echo esc_attr($badge_position); ?> align-<?php echo esc_attr($badge_align); ?>">
                <ul>
					<?php if(!empty($terms)) : $term = $terms[0];
						$bg = get_term_meta($term->term_id, 'shopengine_tag_bg_color', true);
						?>
						<?php if(!empty(self::_discount_percentage())) : ?>
                            <li class="badge no-link off"><?php echo '-' . esc_html(self::_discount_percentage()) . '%'; ?></li>
						<?php endif; ?>
                        <li class="badge tag">
                            <a <?php if(!empty($bg)) : ?>style="background-color:<?php echo esc_attr($bg); ?>" <?php endif; ?>
                               href="<?php echo get_term_link($term->term_id); ?>"><?php echo esc_html($term->name); ?></a>
                        </li>
					<?php endif;

					if($product->is_on_sale()) {
						echo "<li class='badge no-link sale'>" . esc_html__('Sale!', 'shopengine') . "</li>";
					}
					?>
                </ul>
            </div>
		<?php
		endif;
	}


	public static function _product_image($settings = null) {
		global $product;
		?>
        <div class='product-thumb'>
            <a href="<?php echo get_the_permalink(); ?>">
				<?php echo woocommerce_get_product_thumbnail($product->get_id()); ?>
            </a>

            <!-- end sale date -->
			<?php
			if(!empty($settings['counter_position']) && $settings['counter_position'] == 'image') {
				self::_product_sale_end_date($settings);
			}
			?>
            <!-- tag and sale badge -->
			<?php self::_product_tag_sale_badge($settings); ?>

            <!-- show group buttons -->
			<?php
			if(isset($settings['shopengine_group_btns']) && $settings['shopengine_group_btns'] === 'yes') {

				$data_attr = apply_filters('shopengine/group_btns/optional_tooltip_data_attr', '');

				?>
                <div class="loop-product--btns" <?php echo esc_attr($data_attr)?>>
                    <div class="loop-product--btns-inner">
						<?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
				<?php
			}
			?>

        </div>
		<?php
	}

	public static function _product_sale_end_date($settings) {
		$date = get_post_meta(get_the_id(), '_sale_price_dates_to', true);
		if(!empty($date)) :
			$formatted_date = date("Y-m-d", $date);
			$config = [
				'days'    => esc_html__('Days', 'shopengine'),
				'hours'   => esc_html__('Hours', 'shopengine'),
				'minutes' => esc_html__('Minutes', 'shopengine'),
				'seconds' => esc_html__('Seconds', 'shopengine'),
			];

			?>
            <div data-prefix="<?php echo !empty($settings['counter_prefix']) ? $settings['counter_prefix'] : ''; ?>"
                 class="product-end-sale-timer <?php echo !empty($settings['counter_position']) ? 'counter-position-' . esc_attr($settings['counter_position']) : ''; ?>"
                 data-config='<?php echo json_encode($config); ?>'
                 data-date="<?php echo esc_attr($formatted_date); ?>"></div>
		<?php
		endif;
	}

	public static function _product_category($settings = null) {
		global $product;

		$terms = get_the_terms($product->get_id(), 'product_cat');
		$terms_count = count($terms);

		if($terms_count > 0) {
			echo "<div class='product-category'><ul>";
			foreach($terms as $key => $term) {
				$sperator = $key !== ($terms_count - 1) ? ',' : '';
				echo "<li><a href='" . get_term_link($term->term_id) . "'>" . esc_html($term->name) . $sperator . "</a></li>";
			}
			echo "</ul></div>";
		}
	}

	public static function _discount_percentage($settings = null) {
		global $product;

		$product_data = $product->get_data();
		$show_tag = (isset($settings['show_tag']) && !empty($settings['show_tag'])) ? esc_attr($settings['show_tag']) : 'yes';
		$output = '';
		if($show_tag == 'yes' && !empty($product_data['regular_price']) && $product_data['sale_price']) {
			$percentage = round((($product_data['regular_price'] - $product_data['sale_price']) / $product_data['regular_price']) * 100);

			return $percentage;
		}

		return '';
	}


	public static function _product_title($settings = null) {
		?>
        <h3 class='product-title'>
            <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
        </h3>
		<?php
	}

	public static function _product_rating($settings = null) {

		global $product;
		?>
        <div class="product-rating">
			<?php
			if($product->get_rating_count() > 0) {
				woocommerce_template_loop_rating();
			} else {
				echo sprintf('<div class="star-rating">%1$s</div>', wc_get_star_rating_html(0, 0));
			}

			// review count
			echo sprintf('<span class="rating-count">(%1$s)</span>', $product->get_review_count());
			?>
        </div>
		<?php
	}


	public static function _product_price($settings = null) {
		?>
        <div class="product-price">
			<?php woocommerce_template_single_price(); ?>
        </div>
		<?php
	}

	public static function _product_description($settings = null) {
		global $product;
		$product_data = $product->get_data($product->get_id());
		?>
        <div class="prodcut-description">
			<?php echo apply_filters('shopengine_product_short_description', $product_data['description']); ?>
        </div>

		<?php
	}

	public static function _product_buttons($settings = null) {
		
		if( isset($settings['shopengine_group_btns']) && $settings['shopengine_group_btns'] === 'yes'): ?>
            <div class="add-to-cart-bt">
				<?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
		<?php endif;
	}


	/**
     * todo - check the keys for refund and cancelled [wc-cancelled, wc-refunded ]
     *
	 * @param $product_id
	 * @param int $variation_id
	 * @return int
	 */
	public static function get_total_sale_count($product_id, $variation_id = 0) {

		global $wpdb;

		$qry = 'SELECT sum(lookup.product_qty) as total FROM `'.$wpdb->prefix.'wc_order_product_lookup` as lookup';
		$qry .=' LEFT JOIN '.$wpdb->prefix.'wc_order_stats AS stat on lookup.order_id = stat.order_id ';
		$qry .=' WHERE `product_id` = '.intval($product_id).' and variation_id = '.intval($variation_id);
		$qry .= ' and stat.status NOT IN (\'wc-cancelled\', \'wc-refunded\') ;';
        $result =  $wpdb->get_row($qry);
		$total = is_object($result) ? $result->total : 0;

		return  intval( $total ) ;
	}


	public static function is_guest_checkout_allowed() {

		return 'yes' === get_option('woocommerce_enable_guest_checkout');
	}

	public static function is_login_allowed_during_checkout() {

		return 'yes' === get_option('woocommerce_enable_checkout_login_reminder');
	}


	private static function generate_products_meta() {
		global $wpdb;
		$post_type = 'product';
		$query     = "
        SELECT DISTINCT($wpdb->postmeta.meta_key) 
        FROM $wpdb->posts 
        LEFT JOIN $wpdb->postmeta 
        ON $wpdb->posts.ID = $wpdb->postmeta.post_id 
        WHERE $wpdb->posts.post_type = '%s' 
        AND $wpdb->postmeta.meta_key != '' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[_0-9].+$)' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[0-9]+$)'
    ";
		$meta_keys = $wpdb->get_col( $wpdb->prepare( $query, $post_type ) );
		//set_transient( 'shopengine-all-products_meta_keys', $meta_keys, 60 * 60 * 0.01 );

		return $meta_keys;
	}

	public static function get_products_meta_keys() {
		//$cache = get_transient( 'shopengine-all-products_meta_keys' );
		return   static::generate_products_meta();
	}



    public static function get_template_type($pid) {

	    return get_post_meta($pid, Action::get_meta_key_for_type(), true);
    }

	public static function get_template_builder_type($pid) {

        return get_post_meta($pid, Action::get_meta_key_for_edit_with(), true);
	}
}
