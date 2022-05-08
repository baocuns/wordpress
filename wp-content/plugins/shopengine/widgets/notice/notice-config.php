<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Notice_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'notice';
	}

	public function get_title() {
		return esc_html__('Notice', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_categories';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'checkout', 'notice', 'single'];
	}

	public function get_template_territory() {
		return ['single', 'checkout', 'quick_checkout'];
	}
}
