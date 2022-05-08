<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Payment_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-payment';
	}

	public function get_title() {
		return esc_html__('Checkout Payment', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-checkout_payment';
	}

	public function get_categories() {
		return ['shopengine-checkout'];
	}

	public function get_keywords() {
		return ['checkout payment', 'checkout', 'shopengine', 'payment method', 'payment'];
	}

	public function get_template_territory() {
		return ['checkout', 'quick_checkout'];
	}
}
