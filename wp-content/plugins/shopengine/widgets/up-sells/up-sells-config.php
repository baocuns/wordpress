<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Up_Sells_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'up-sells';
	}

	public function get_title() {
		return esc_html__('Product Upsells', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-upsell';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'upsells', 'product', 'single product'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
