<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Description_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'product-description';
	}


	public function get_title() {
		return esc_html__('Product description', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_content';
	}


	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'description', 'content'];
	}


	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
