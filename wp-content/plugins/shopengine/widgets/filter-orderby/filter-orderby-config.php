<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Filter_OrderBy_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'filter-orderby';
	}

	public function get_title() {
		return esc_html__('Order By Filter', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-cross_sells';
	}

	public function get_categories() {
		return ['shopengine-archive'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shop', 'store', 'title', 'heading', 'product'];
	}

	public function get_template_territory() {
		return ['shop', 'archive'];
	}
}
