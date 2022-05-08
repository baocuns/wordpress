<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Form_Billing_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-form-billing';
	}


	public function get_title() {
		return esc_html__('Checkout Form Billing', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-checkout_form_billing';
	}


	public function get_categories() {
		return ['shopengine-checkout'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'checkout', 'checkout form billing'];
	}


	public function get_template_territory() {
		return ['checkout', 'quick_checkout'];
	}
}
