<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Additional_Information_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'additional-information';
	}

	public function get_title() {
		return esc_html__('Product Additional Information', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-additional_info';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['shopengine', 'woocommerce', 'additional information', 'single product'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'account_orders_view', 'quick_checkout'];
	}
}
