<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Add_To_Cart_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'add-to-cart';
	}


	public function get_title() {
		return esc_html__('Add To Cart', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-add_to_cart';
	}


	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'cart', 'add to cart'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
