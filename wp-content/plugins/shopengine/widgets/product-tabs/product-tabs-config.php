<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Tabs_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'product-tabs';
	}


	public function get_title() {
		return esc_html__('Product Tabs', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_tabs';
	}


	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['shopengine', 'woocommerce', 'product tabs', 'tabs'];
	}


	public function is_reload_preview_required() {
		return true;
	}


	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
