<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Filter_Products_Per_Page_Config extends \ShopEngine\Base\Widget_Config{


    public function get_name() {
		return 'filter-products-per-page';
	}

	public function get_title() {
		return esc_html__('Products Per Page Filter', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_products';
	}

	public function get_categories() {
		return ['shopengine-archive'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shop', 'store', 'products per page', 'product'];
	}

	public function get_template_territory() {
		return ['shop', 'archive'];
	}
}
