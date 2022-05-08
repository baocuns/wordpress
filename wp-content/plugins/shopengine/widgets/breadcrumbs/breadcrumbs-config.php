<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Breadcrumbs_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'breadcrumbs';
	}

	public function get_title() {
		return esc_html__('Breadcrumbs', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-breadcrumb';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'Breadcrumbs'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
