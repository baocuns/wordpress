<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Advanced_Search_Config extends \ShopEngine\Base\Widget_Config {

	public function get_name() {
		return 'advanced-search';
	}

	public function get_title() {
		return esc_html__('Advanced Search', 'shopengine');
	}

	public function get_icon() {
		return 'eicon-search shopengine-widget-icon';
	}

	public function get_categories() {
		return ['shopengine-general'];
	}

	public function get_keywords() {
		return ['woocommerce', 'shop', 'archive', 'advanced search', 'search', 'advanced', 'shopengine'];
	}

	public function get_template_territory() {
		return [];
	}

	public function custom_init() {

		add_action('rest_api_init', function () {

			register_rest_route('shopengine/v1', 'advanced-search', [
				'methods'             => 'GET',
				'permission_callback' => '__return_true',
				'callback'            => [$this, 'search_result'],
			]);
		});
	}

	public function search_result() {

		include $this->get_widget_dir() . 'screens/search-result.php';

		exit();
	}
}
