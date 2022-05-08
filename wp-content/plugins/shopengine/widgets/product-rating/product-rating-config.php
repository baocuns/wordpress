<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Rating_Config extends \ShopEngine\Base\Widget_Config
{

	public function get_name() {
		return 'product-rating';
	}

	public function get_title() {
		return esc_html__('Product Rating', 'shopengine');
	}

	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_reviews';
	}

	public function get_categories() {
		return ['shopengine-single'];
	}

	public function get_keywords() {
		return ['woocommerce', 'rating', 'product', 'single product', 'review', 'comments', 'stars'];
	}

	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
