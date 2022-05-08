<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Archive_Description_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'archive-description';
	}

	public function get_title() {
		return esc_html__('Archive Description', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_description';
	}

	public function get_categories() {
		return ['shopengine-archive'];
	}

	public function get_keywords() {
		return ['shopengine', 'shop', 'archive', 'description', 'archive description'];
	}

	public function get_template_territory() {
		return ['shop', 'archive'];
	}
}
