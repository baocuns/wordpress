<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Return_To_Shop_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'return-to-shop';
	}

	public function get_title() {
		return esc_html__('Return to shop', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-return_to_shop';
	}

	public function get_categories() {
		return ['shopengine-cart'];
	}

	public function get_keywords() {
		return ['return', 'return to shop', 'shop', 'shopengine'];
	}

	public function get_template_territory() {
		return ['cart', 'single', 'checkout', 'quick_checkout', 'empty_cart'];
	}
}
