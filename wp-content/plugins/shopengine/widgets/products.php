<?php

namespace ShopEngine\Widgets;

use Elementor\Controls_Manager;
use ShopEngine\Core\Builders\Action;

defined('ABSPATH') || exit;

class Products {

	use \ShopEngine\Traits\Singleton;
	use Lazy_Cache;

	public function no_product_to_preview() {
		return '<div class="shopengine-notice shopengine-notice-warning">
        ' . esc_html__('There is no default product to show preview. Please add a "Simple Type" product first', 'shopengine') . '
        </div>';
	}

	public function get_a_simple_product($type = 'simple') {

		$args = [
			'type'    => [$type],
			'status'  => ['publish', 'draft'],
			'limit'   => 1,
			'orderby' => 'ID',
			'order'   => 'DESC',
		];

		$prod = $this->cache('wc_get_products', $args);


		return empty($prod[0]) ? false : $prod[0];
	}

	public function get_a_simple_product_id($type = 'simple') {
		$prod = $this->get_a_simple_product($type);

		return ($prod === false) ? false : $prod->get_id();
	}

	public function get_a_product_id() {

		$prod = $this->get_a_simple_product();

		return ($prod === false) ? false : $prod->get_id();
	}

	public function product_tab_content_preview($content) {

		$prod = $this->get_a_simple_product();

		return ($prod === false) ? false : $prod->get_description();
	}


	public function get_a_orders_from_my_account() {

		$args = [
			'customer' => get_current_user_id(),
			'limit'    => 1,
			'return'   => 'ids',
		];

		$customer_orders = $this->cache('wc_get_orders-woocommerce_my_account_my_orders_query', $args);

		return empty($customer_orders) ? 0 : $customer_orders[0];
	}

	/**
	 * Get order id
	 */
	public function get_a_order_id() {
		return $this->cache('wc_get_orders', ['limit' => 1]);
	}


	public function get_a_variable_product_id() {

		$args = array(
			'posts_per_page' => 1,
			'post_type'      => 'product_variation',
			'post_status'    => 'publish',
		);

		$product = get_posts($args);
		$product = $this->cache('get_posts', $args);

		return empty($product[0]) ? 0 : $product[0]->post_parent;
	}


	/**
	 * Grab a product for elementor editor preview
	 *
	 * @param $post_type
	 * @return string
	 */
	public function get_product($post_type) {

		global $product;

		if('product' == $post_type) {
			return $product;
		}

		$product = $this->get_a_simple_product();

		return empty($product) ? new \stdClass() : $product;
	}

	/**
	 * Just a workaround for gutenberg support fro server rendering
	 *
	 * @return false|int|mixed|\stdClass|string|\WC_Order|\WC_Product|\WP_Post
	 */
	public function get_the_product() {

		global $product;

		// If the WC_product Object is not defined globally
		if ( ! is_a( $product, 'WC_Product' ) ) {
			$product = wc_get_product( get_the_id() );
		}

		if(!empty($product) && $product->get_type() === 'product') {

			return $product;
		}

		$product = $this->get_a_simple_product();

		return empty($product) ? new \stdClass() : $product;
	}


	public function get_variation_product() {

		global $product;

		$post_type = get_post_type();

		if('product' == $post_type) {

			return $product;
		}

		$prod_id = $this->get_a_variable_product_id();

		$product = $this->cache('wc_get_product', $prod_id);

		return empty($product) ? new \stdClass() : $product;
	}


	public function get_random_product_id() {

		global $product;

		$post_type = get_post_type();

		if('product' == $post_type) {

			$prod_id = $product->get_id();

		} else {

			$prod_id = $this->get_a_product_id();
		}

		return $prod_id;
	}


	public function get_widget_template($widget_name, $filename = 'default', $widget_dir = null) {
		$widget_dir = $widget_dir ?? \ShopEngine::widget_dir();

		$widget_name = ltrim($widget_name, 'shopengine');
		$widget_name = ltrim($widget_name, '-');

		return $widget_dir . $widget_name . '/screens/' . $filename . '.php';
	}


	public function get_template_type_by_id($page_id) {

		$data = $this->cache('get_post_meta', [$page_id, Action::PK__SHOPENGINE_TEMPLATE, true]);

		return empty($data['form_type']) ? '' : $data['form_type'];
	}

	public function get_all_color_terms() {

		$all_color_terms = $this->cache('get_all_color_terms', null);

		return $all_color_terms;
	}

	public function get_all_image_terms() {

		$all_image_terms = $this->cache('get_all_image_terms', null);

		return $all_image_terms;
	}

	public function get_all_label_terms() {

		$all_label_terms = $this->cache('get_all_label_terms', null);

		return $all_label_terms;
	}

	public function get_wc_product($product_id) {

		return wc_get_product( $product_id );
	}

	public function get_product_obj($is_editor) {

		if($is_editor) {

			return \ShopEngine\Widgets\Products::instance()->get_a_simple_product();
		}

		$p_obj   = get_post();

		return \ShopEngine\Widgets\Products::instance()->get_wc_product($p_obj->ID);
	}

}
