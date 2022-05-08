<?php

namespace ShopEngine\Widgets;

defined('ABSPATH') || exit;

use ShopEngine\Core\Register\Widget_List;
use ShopEngine\Widgets\Init\Enqueue_Scripts;
use ShopEngine\Widgets\Init\Route;


class Manifest{

	private $widget_list;

	public function init() {

		new Enqueue_Scripts();
		new Route();

		$this->manifest_widgets();

		add_action('elementor/elements/categories_registered', [$this, 'widget_categories']);
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
	}

	public function manifest_widgets() {

		foreach(Widget_List::instance()->get_list(true, 'active') as $widget) {

			if(isset($widget['path'])){

				if(file_exists($widget['path'] . '/' . $widget['slug'] . '-config.php')){
					require_once $widget['path'] . '/' . $widget['slug'] . '-config.php';
				}
			}
				
			if(class_exists($widget['config_class'])){
				$widget_config = new $widget['config_class']();

				if($widget_config->custom_inline_css() !== false){
					wp_add_inline_style( 'shopengine-elementor-style', $widget_config->custom_inline_css());
				}
		
				if($widget_config->custom_inline_js() !== false){
					wp_add_inline_script( 'shopengine-elementor-script', $widget_config->custom_inline_css());
				}
		
				if($widget_config->custom_init() !== false){
					add_action('init', [$widget_config, 'custom_init']);
				}
			}
		}
	}

	public function register_widgets() {

		foreach(Widget_List::instance()->get_list(true, 'active') as $widget) {

			if(isset($widget['path'])){

				if(file_exists($widget['path'] . '/' . $widget['slug'] . '.php')){
					require_once $widget['path'] . '/' . $widget['slug'] . '.php';
				}
			}

			if(isset($widget['base_class']) && class_exists($widget['base_class'])){

				\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $widget['base_class']());
			}

		}

	}

	public function widget_categories($elements_manager) {

		$elements_manager->add_category('shopengine-general', [
			'title' => esc_html__('ShopEngine General', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
		$elements_manager->add_category('shopengine-single', [
			'title' => esc_html__('ShopEngine Single Product', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
		$elements_manager->add_category('shopengine-cart', [
			'title' => esc_html__('ShopEngine Cart', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
		$elements_manager->add_category('shopengine-archive', [
			'title' => esc_html__('ShopEngine Product Archive', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
		$elements_manager->add_category('shopengine-checkout', [
			'title' => esc_html__('ShopEngine Checkout', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
		$elements_manager->add_category('shopengine-order', [
			'title' => esc_html__('ShopEngine Order', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
		$elements_manager->add_category('shopengine-my_account', [
			'title' => esc_html__('ShopEngine My Account', 'shopengine'),
			'icon' => 'fa fa-plug',
		]);
	}
}

