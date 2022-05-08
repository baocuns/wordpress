<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Archive_View_Mode_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'archive-view-mode';
	}

	public function get_title() {
		return esc_html__('Archive View Mode', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-grid-1';
	}

	public function get_categories() {
		return ['shopengine-archive'];
	}

	public function get_keywords() {
		return ['woocommerce', 'view', 'view mode', 'archive view mode', 'shopengine'];
	}

	public function get_template_territory() {
		return ['shop', 'archive'];
	}
}
