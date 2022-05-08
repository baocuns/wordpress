<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Cross_Sells_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'cross-sells';
	}


	public function get_title() {
		return esc_html__('Cross-Sell', 'shopengine');
	}


	public function get_categories() {
		return ['shopengine-cart'];
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-cross_sells';
	}


	public function get_keywords() {
		return ['woocommerce', 'shop', 'Cross Sells', 'cart', 'product', 'table', 'tabs', 'Sells'];
	}


	public function get_template_territory() {
		return ['cart', 'quick_checkout'];
	}
}
