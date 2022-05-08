<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Form_Shipping_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-form-shipping';
	}

	public function get_title() {
		return esc_html__('Checkout Form Shipping', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine shopengine-widget-icon shopengine-icon-checkout_form_shipping';
	}

	public function get_categories() {
		return ['shopengine-checkout'];
	}

	public function get_keywords() {
		return ['checkout', 'shopengine', 'checkout form shipping', 'form', 'shopengine'];
	}

	public function get_template_territory() {
		return ['checkout', 'quick_checkout'];
	}
}
