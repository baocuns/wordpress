<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Stock_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'product-stock';
	}

	public function get_title() {
		return esc_html__('Product Stock', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-related_product';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['woocommerce', 'stock', 'shopengine'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
