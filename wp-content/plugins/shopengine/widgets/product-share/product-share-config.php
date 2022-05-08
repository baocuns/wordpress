<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Share_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'product-share';
	}


	public function get_title() {
		return esc_html__('Product Share', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_share';
	}


	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'share', 'social share'];
	}


	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
