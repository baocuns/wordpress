<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Deal_Products_Config extends \ShopEngine\Base\Widget_Config{

    public function get_name() {
		return 'deal-products';
	}

	public function get_title() {
		return esc_html__('Deal Products', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_products';
	}

   
	public function get_categories() {
		return ['shopengine-general'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'deal products', 'deal', 'product'];
	}

	public function get_template_territory() {
		return [];
	}
}
