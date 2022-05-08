<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Coupon_Form_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-coupon-form';
	}

	public function get_title() {
		return esc_html__('Coupon Form', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-checkout_coupon_form';
	}

	public function get_categories() {
		return ['shopengine-checkout'];
	}

	public function get_keywords() {
		return ['shopengine', 'woocommerce', 'coupon', 'coupon form'];
	}

	public function get_template_territory() {
		return ['checkout', 'cart', 'quick_checkout'];
	}
}
