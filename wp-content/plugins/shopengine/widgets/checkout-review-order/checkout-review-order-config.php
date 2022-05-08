<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Review_Order_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-review-order';
	}


	public function get_title() {
		return esc_html__('Checkout Order Review', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-checkout_review_order';
	}


	public function get_categories() {
		return ['shopengine-checkout'];
	}


	public function get_keywords() {
		return ['checkout', 'shopengine', 'checkout review orders', 'review orders'];
	}


	public function get_template_territory() {
		return ['checkout', 'quick_checkout'];
	}
}
