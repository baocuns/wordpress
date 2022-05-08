<?php

/**
 * Plugin Name: ShopEngine
 * Plugin URI:  https://wpmet.com/plugin/shopengine
 * Description: ShopEngine is the most-complete WooCommerce template builder for Elementor. It helps you build and customize the single product page, cart page, archive page, checkout page, order page, my account page, and thank-you page from scratch. It also packed with product comparison, wishlist, quick view, and variation swatches etc.
 * Version: 2.2.2
 * Author: Wpmet
 * Author URI:  https://wpmet.com
 * Text Domain: shopengine
 * Domain Path: /languages
 * License:  GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 */


defined('ABSPATH') || exit;


require_once __DIR__ . '/autoloader.php';


final class ShopEngine {

	const SHOPENGINE_PREFIX = 'shopengine-builder';

	/**
	 * Plugin Version
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function version() {
		return '2.2.2';
	}


	/**
	 * Package type
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function package_type() {
		return apply_filters('shopengine/core/package_type', 'free');
	}

	public static function landing_page($part = 'pricing') {
		$site = trailingslashit('https://wpmet.com/plugin/shopengine/' . $part);

		return $site;
	}


	static function license_status() {

		if(!class_exists('ShopEngine_Pro')) {
			return 'invalid';
		}

		if(ShopEngine\Libs\License\Helper::instance()->status() != 'valid') {
			return 'invalid';
		}

		return 'valid';
	}

	public static function license_data() {
		if(!class_exists('\ElementsKit_Lite\Libs\Framework\Classes\Utils')) {
			return [
				'key'            => '',
				'checksum'       => '',
				'plugin_package' => self::package_type(),
			];
		}

		return array_merge(
			ShopEngine\Libs\License\Helper::instance()->get_license(),
			['plugin_package' => self::package_type()]
		);
	}


	/**
	 * Product ID
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	static function product_id() {
		return '0';
	}


	/**
	 * Plugin Author Name
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	static function author_name() {
		return 'Wpmet';
	}

	public static function store_name() {
		return 'wpmet';
	}


	/**
	 * Minimum Elementor Version required to run the plugin.
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function min_el_version() {
		return '3.0.0';
	}


	/**
	 * Minimum PHP Version required to run the plugin
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function min_php_version() {
		return '7.0';
	}


	/**
	 * Minimum Woocommerce version required to run the plugin.
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function min_woo_version() {
		return '4.1';
	}


	/**
	 * Plugin file plugins's root file.
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function plugin_file() {
		return __FILE__;
	}


	/**
	 * Plugin url
	 *
	 * @return mixed
	 * @since 1.0.0
	 */
	public static function plugin_url() {
		return trailingslashit(plugin_dir_url(__FILE__));
	}


	/**
	 * Plugin dir
	 *
	 * @return mixed
	 * @since 1.0.0
	 */
	public static function plugin_dir() {
		return trailingslashit(plugin_dir_path(__FILE__));
	}


	/**
	 * Plugin's widget directory.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function widget_dir() {
		return self::plugin_dir() . 'widgets/';
	}


	/**
	 * Plugin's widget url.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function widget_url() {
		return self::plugin_url() . 'widgets/';
	}

	/**
	 * Plugin's widget directory.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function module_dir() {
		return self::plugin_dir() . 'modules/';
	}


	/**
	 * Plugin's widget url.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function module_url() {
		return self::plugin_url() . 'modules/';
	}


	/**
	 * Plugin core directory
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function core_dir() {
		return self::plugin_dir() . 'core/';
	}

	/**
	 * Plugin core url
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function core_url() {
		return self::plugin_url() . 'core/';
	}


	/**
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function views_dir() {
		return self::plugin_dir() . 'views/';
	}


	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		add_action('init', [$this, 'i18n']);
		add_action('plugins_loaded', [$this, 'init'], 100);
	}


	/**
	 * Load text domain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain('shopengine', false, self::plugin_dir() . 'languages/');
	}


	public function init() {
		do_action('shopengine/before_loaded');
		ShopEngine\Plugin::instance()->init();
		do_action('shopengine/after_loaded');
	}
}


new ShopEngine();

function activate_shopengine() {

	\ShopEngine\Core\Template_Cpt::instance()->init();

	flush_rewrite_rules();
}


function deactivate_shopengine() {

}

register_activation_hook(__FILE__, 'activate_shopengine');

register_deactivation_hook(__FILE__, 'deactivate_shopengine');

