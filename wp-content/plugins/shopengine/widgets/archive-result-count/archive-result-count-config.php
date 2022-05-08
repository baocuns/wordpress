<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Archive_Result_Count_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'archive-result-count';
	}

	public function get_title() {
		return esc_html__('Archive Result Count', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_title';
	}

	public function get_categories() {
		return ['shopengine-archive'];
	}

	public function get_keywords() {
		return ['woocommerce', 'title', 'archive', 'archive result count', 'result count'];
	}

	public function get_template_territory() {
		return ['shop', 'archive'];
	}
}
