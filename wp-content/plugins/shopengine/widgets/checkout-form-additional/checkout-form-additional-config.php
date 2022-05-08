<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Form_Additional_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'checkout-form-additional';
	}

	public function get_title() {
		return esc_html__('Checkout Form Additional', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-checkout_form_additional';
	}

	public function get_categories() {
		return ['shopengine-checkout'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'checkout', 'checkout form additional'];
	}

	public function get_template_territory() {
		return ['checkout', 'quick_checkout'];
	}
}
