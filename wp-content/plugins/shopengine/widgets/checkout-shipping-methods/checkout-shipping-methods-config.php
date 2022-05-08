<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Shipping_Methods_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-shipping-methods';
	}


	public function get_title() {
		return esc_html__('Checkout Shipping Methods', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-ck_shipping_methods';
	}


	public function get_categories() {
		return ['shopengine-checkout'];
	}


	public function get_keywords() {
		return ['checkout', 'shopengine', 'checkout shipping method', 'shipping method'];
	}


	public function get_template_territory() {
		return ['checkout', 'quick_checkout'];
	}
}
