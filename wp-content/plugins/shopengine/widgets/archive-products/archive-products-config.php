<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Archive_Products_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'archive-products';
	}


	public function get_title() {
		return esc_html__('Archive Products', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_products';
	}


	public function get_categories() {
		return ['shopengine-archive'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'archive', 'archive products'];
	}

	public function get_template_territory() {
		return ['shop', 'archive'];
	}
}
