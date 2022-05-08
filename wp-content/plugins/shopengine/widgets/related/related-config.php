<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Related_Config extends \ShopEngine\Base\Widget_Config {

    public function get_name() {
		return 'related';
	}

	public function get_title() {
		return esc_html__('Related Products', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-related_product';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'related', 'product', 'single product'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
