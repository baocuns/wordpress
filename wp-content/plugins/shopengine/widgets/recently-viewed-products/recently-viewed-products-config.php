<?php

namespace Elementor;

defined('ABSPATH') || exit;

class Shopengine_Recently_Viewed_Products_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'recently-viewed-products';
	}

	public function get_title() {
		return esc_html__('Recently Viewed Products', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-related_product';
	}

	public function get_categories() {
		return ['shopengine-general'];
	}

	public function get_keywords() {
		return ['woocommerce', 'recently', 'viewed', 'product', 'single product'];
	}

	public function get_template_territory() {
		return [];
	}
}
