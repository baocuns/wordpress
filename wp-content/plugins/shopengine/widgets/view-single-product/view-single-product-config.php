<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_View_Single_Product_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'view-single-product';
	}

	public function get_title() {
		return esc_html__('View Single Product', 'shopengine');
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_products';
	}

	public function get_keywords() {
		return ['woocommerce', 'product', 'single', 'view single product', 'shopengine'];
	}

	public function get_template_territory() {
		return ['quick_view'];
	}
}