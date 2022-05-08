<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Empty_Cart_Message_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'empty-cart-message';
	}

	public function get_title() {
		return esc_html__('Empty Cart Message', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-empty_cart_message';
	}

	public function get_categories() {
		return ['shopengine-cart'];
	}

	public function get_keywords() {
		return ['empty cart', 'cart', 'message', 'shopengine'];
	}

	public function get_template_territory() {
		return ['empty_cart'];
	}
}
