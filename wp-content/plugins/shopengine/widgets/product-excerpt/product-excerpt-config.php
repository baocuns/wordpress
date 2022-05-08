<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Excerpt_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'product-excerpt';
	}


	public function get_title() {
		return esc_html__('Product Excerpt', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_excerpt';
	}


	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'excerpt', 'product excerpt'];
	}

	public function get_template_territory() {
		return ['single', 'quick_checkout'];
	}
}
