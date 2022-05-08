<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Filterable_Product_List_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'filterable-product-list';
	}

	public function get_title() {
		return esc_html__('Filterable Product List', 'shopengine');
	}


	public function get_categories() {
		return ['shopengine-general'];
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-cross_sells';
	}


	public function get_keywords() {
		return ['woocommerce', 'filter', 'filterable product list', 'product list', 'list', 'shopengine'];
	}

	public function get_template_territory() {
		return [];
	}
}
