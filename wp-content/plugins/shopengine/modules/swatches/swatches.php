<?php

namespace ShopEngine\Modules\Swatches;

use ShopEngine\Modules\Swatches\Loop_Product_Support\Shopengine_Swatches;
use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;


class Swatches
{

	const MODULE_VERSION = '1.0.0';

	const PA_COLOR = 'shopengine_color';
	const PA_IMAGE = 'shopengine_image';
	const PA_LABEL = 'shopengine_label';

	private $attribute_types = [];

	use Singleton;


	public static function get_module_uri() {

		return plugin_dir_url(__FILE__);
	}


	public static function get_module_dir() {

		return plugin_dir_path(__FILE__);
	}


	public static function asset_source($type = 'css', $directory = null) {

		return self::get_module_uri() . 'assets/' . $type . '/' . $directory;
	}


	public function init() {

		$this->set_attribute_types(self::PA_COLOR, esc_html__('Shopengine Color', 'shopengine'));
		$this->set_attribute_types(self::PA_IMAGE, esc_html__('Shopengine Image', 'shopengine'));
		$this->set_attribute_types(self::PA_LABEL, esc_html__('Shopengine Label', 'shopengine'));


		//Add option to attribute.......................................................
		add_filter('product_attributes_type_selector', [$this, 'push_attribute_types']);

		if(is_admin()) {

			add_action('admin_init', [$this, 'init_hooks']);
			add_action('admin_print_scripts', [$this, 'enqueue']);
			add_action('admin_init', [$this, 'includes_product']);
		}


		if(!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {

			add_action('init', [$this, 'init_frontend_hook']);
		}

		/**
		 * add swatches to product loop
		 */
		Shopengine_Swatches::getInstance();
	}


	public function push_attribute_types($types) {

		$types = array_merge($types, $this->attribute_types);

		return $types;
	}


	private function set_attribute_types($key, $title) {

		$this->attribute_types[$key] = $title;

		return $this;
	}


	public function includes_product() {

		Admin_Product::instance()->init();
	}


	public function init_hooks() {

		Attribute_Hooks::instance()->init();
	}


	public function init_frontend_hook() {

		Frontend::instance()->init();
	}


	public function enqueue() {

		$screen = get_current_screen();
		if(empty($screen)) {
			return;
		}

		if(strpos($screen->id, 'edit-pa_') === false && strpos($screen->id, 'product') === false) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_style('shopengine-css-admin', Swatches::asset_source('css', 'admin.css'), ['wp-color-picker'], Swatches::MODULE_VERSION);
		wp_enqueue_script('shopengine-js-admin', Swatches::asset_source('js', 'admin.js'), ['jquery', 'wp-color-picker', 'wp-util'], Swatches::MODULE_VERSION, true);

		wp_localize_script(
			'shopengine-js-admin',
			'swatch_conf',
			[
				'i18n'        => [
					'title'  => esc_html__('Choose an image', 'shopengine'),
					'button' => esc_html__('Use image', 'shopengine'),
				],
				'dummy' => Helper::get_dummy(),
			]
		);
	}


	public function get_available_types() {

		return $this->attribute_types;
	}


	public static function is_module_active() {

		// todo - implement the logic later...........

		return true;
	}
}
