<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Title_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'product-title';
	}

	public function get_title() {
		return esc_html__('Product Title', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_title';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shop', 'store', 'title', 'heading', 'product'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
