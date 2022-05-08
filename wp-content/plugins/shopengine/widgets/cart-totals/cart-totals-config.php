<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Cart_Totals_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'cart-totals';
	}

	public function get_title() {
		return esc_html__('Cart Total', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-shopping_cart_4';
	}

	public function get_categories() {
		return ['shopengine-cart'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'cart total'];
	}

	public function get_template_territory() {
		return ['cart', 'empty_cart'];
	}
}
