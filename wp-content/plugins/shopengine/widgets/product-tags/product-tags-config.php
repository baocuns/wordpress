<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Tags_Config extends \ShopEngine\Base\Widget_Config{

	public function get_name() {
		return 'product-tags';
	}

	public function get_title() {
		return esc_html__('Product Tags', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_tabs';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'tags', 'product tags'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
