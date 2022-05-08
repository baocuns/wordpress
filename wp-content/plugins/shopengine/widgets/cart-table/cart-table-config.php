<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Cart_Table_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'cart-table';
	}


	public function get_title() {
		return esc_html__('Cart Table', 'shopengine');
	}


	public function get_categories() {
		return ['shopengine-cart'];
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-cart_table';
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'cart'];
	}


	public function get_template_territory() {
		return ['cart', 'empty_cart'];
	}
}
