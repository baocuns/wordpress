<?php

namespace ShopEngine;

use ShopEngine\Compatibility\Conflicts\Manifest as Conflict_Manifest;
use ShopEngine\Core\Builders\Base;
use ShopEngine\Core\Query_Modifier;
use ShopEngine\Core\Template_Cpt;
use ShopEngine\Libs\License\License_Route;
use ShopEngine\Libs\Updater\Init as Updater;
use ShopEngine\Modules\Manifest as Module_Manifest;
use ShopEngine\Widgets\Manifest;

defined('ABSPATH') || exit;

/**
 * Plugin final Class.
 * Handles dynamically loading classes only when needed. Check Elementor Plugin, Woocomerce Plugin Loaded or Install.
 *
 * @since 1.0.0
 */
final class Plugin {

	private static $instance;

	/**
	 * __construct function
	 * @since 1.0.0
	 */
	public function __construct() {
		// load autoload method
		Autoloader::run();
	}


	/**
	 * Public function init.
	 * call function for all
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$error = false;

		// check woocommerce plugin
		if(!did_action('woocommerce_loaded')) {
			add_action('admin_notices', [$this, 'missing_woocommerce']);

			$error = true;
		}

		$check_elementor_version = false;

		// Check if Elementor installed and activated.
		 if(!did_action('elementor/loaded')) {

			 if(!did_action('shopengine-gutenberg-addon/before_loaded')) {

				 add_action('admin_notices', [$this, 'missing_elementor']);

				 $error = true;
			 }
		 }

		// Check for required Elementor version.
		 if(did_action('elementor/loaded') && defined('ELEMENTOR_VERSION') && !version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {

			 add_action('admin_notices', [$this, 'failed_elementor_version']);

		 	$error = true;
		 }

		if($error) {
			return;
		}

		add_filter("plugin_action_links_shopengine/shopengine.php", function ($links) {

            $custom_links[] = '<a href="'.admin_url('edit.php?post_type=shopengine-template#getting-started').'" target="_blank">' . esc_html__('Settings', 'shopengine') . '</a>';

            foreach ($custom_links as $custom_link):
                array_unshift($links, $custom_link);
            endforeach;

            if (!is_plugin_active('shopengine-pro/shopengine-pro.php')) {
                $links[] = '<a href="https://wpmet.com/plugin/shopengine/pricing/" style="color:#FCB214;font-weight:700" target="_blank">' . esc_html__('Go Pro', 'shopengine') . '</a>';
            }
            return $links;
        });


		/**
		 * Routes initialization
		 *
		 */
		new License_Route();

		/**
		 * Run pro plugin updater here....
		 *
		 */
		add_action('admin_init', function () {
			if(class_exists('ShopEngine_Pro')) {
				new Updater();
			}
		});


		add_action('wp_loaded', function () {

			if(isset($_REQUEST['preview']) && $_REQUEST['preview'] == 'true' && !empty($_REQUEST['preview_id'])) {

				$pid = (int)$_REQUEST['preview_id'];

				$po = get_post($pid);

				if($po->post_type === Template_Cpt::TYPE) {

					$template = \ShopEngine\Core\Builders\Templates::get_registered_template_data($pid);

					if(empty($template) || !isset($template['url'])) {
						return;
					}

					$param = [
						'shopengine_template_id' => $pid,
						'preview_nonce'          => wp_create_nonce('template_preview_' . $pid),
						'change_template'        => '1',
					];

					$url = \ShopEngine\Utils\Helper::add_to_url($template['url'], $param);

					wp_safe_redirect($url);
					exit;
				}
			}
		});

		// avoid themes for  loading woocommerce functions
		$avoid_themes = ['avada', 'avada child'];

		if(!in_array(strtolower(wp_get_theme()), $avoid_themes)) {
			/**
			 * Ensuring woocommerce functions are loaded before theme is modifying those
			 *
			 */
			require_once WC_ABSPATH . '/includes/wc-template-functions.php';
		}


        if(did_action('elementor/loaded')) {
            // Load custom elementor controls
            new \ShopEngine\Core\Elementor_Controls\Init();

            //Loading the scripts and styles
            add_action('elementor/editor/after_enqueue_styles', [$this, 'js_css_elementor']);
        }


		//Loading public scripts and styles
		add_action('wp_enqueue_scripts', [$this, 'js_css_public']);

		//woocommece theme support
		if(!current_theme_supports('woocommerce')) {
			add_theme_support('woocommerce');
			add_theme_support('wc-product-gallery-zoom');
			add_theme_support('wc-product-gallery-lightbox');
			add_theme_support('wc-product-gallery-slider');
		}


		#Registering new post-type & etc
		Base::instance()->init();

		\ShopEngine\Core\Settings\Base::instance()->init();

		new Libs\Select_Api\Base();

		(new Module_Manifest())->init();

		// working get instance of elementor widget
		(new Manifest())->init();

		Query_Modifier::instance()->init();

		(new Conflict_Manifest())->init();

		// view count
		add_action('get_header', [$this, 'shopengine_track_product_views']);

		// database migrations
		// (new \ShopEngine\Compatibility\Migrations\Migration())->init();
		(new \ShopEngine\Compatibility\Migrations\Temp_Migration())->init();


		// call service providers

		$service_providers = include \ShopEngine::plugin_dir().'core/service-provider-manager.php';
		$method = 'init';
		foreach( $service_providers as $service_provider ){

		  if(class_exists($service_provider) && method_exists($service_provider, $method)) {
            $instance = new $service_provider();
            $instance->$method();
		  }

		}



		add_filter('script_loader_tag', [$this, 'filter_load_type'], 99, 3);
	}


	// add async and defer attributes to enqueued scripts
	public function filter_load_type($tag, $handle, $src) {

		if(strpos($handle, '-async') !== false) {
			$tag = str_replace(' src', ' async="async" src', $tag);
		}

		if(strpos($handle, '-defer') !== false) {
			$tag = str_replace('<script ', '<script defer ', $tag);
		}

		return $tag;
	}

	/**
	 * Public function shopengine_track_product_views
	 * Adding Product Views Count Meta
	 */
	public function shopengine_track_product_views() {

		if(class_exists('WooCommerce') && !is_product()) {
			return;
		}

		$product_id = get_the_id();

		$cookie_name = "shopengine_recent_viewed_product";

		if(isset($_COOKIE[$cookie_name])) {

			$cookie_ids  = $_COOKIE[$cookie_name];
			$product_ids = explode(',', $cookie_ids);

			if(!is_array($product_ids)) {
				$product_ids = [$product_ids];
			}

			$product_ids = array_combine($product_ids, $product_ids);
			unset($product_ids[$product_id]);
			$product_ids[] = $product_id;

			$cookie_value = implode(',', $product_ids);

		} else {
			$cookie_value = $product_id;
		}

		setcookie($cookie_name, $cookie_value, strtotime('+30 days'), '/' );

		$count_key = 'shopengine_product_views_count';
		$count     = get_post_meta($product_id, $count_key, true);

		if($count == '') {
			$count = 1;
			delete_post_meta($product_id, $count_key);
			add_post_meta($product_id, $count_key, '1');
		} else {
			$count++;
			update_post_meta($product_id, $count_key, $count);
		}
	}

	/**
	 * Public function js_css_public .
	 * Include public function
	 *
	 * @since 1.0.0
	 */
	public function js_css_public() {
		wp_enqueue_style('shopengine-icon', \ShopEngine::plugin_url() . 'assets/css/shopengine-icon.css', false, \ShopEngine::version());
		wp_enqueue_style('shopengine-simple-scrollbar-css', \ShopEngine::plugin_url() . 'assets/css/simple-scrollbar.css', false, \ShopEngine::version());
		wp_enqueue_style('shopengine-public-css', \ShopEngine::plugin_url() . 'assets/css/public-style.css', false, \ShopEngine::version());

		// Modal Stylesheet
		wp_register_style('shopengine-modal-styles', \ShopEngine::plugin_url() . 'assets/css/shopengine-modal.css', false, \ShopEngine::version());

		// Modal Script
		wp_register_script('shopengine-modal-script', \ShopEngine::plugin_url() . 'assets/js/shopengine-modal.js', ['jquery'], \ShopEngine::version(), true);

		wp_enqueue_script('shopengine-simple-scrollbar.js-js', \ShopEngine::plugin_url() . 'assets/js/simple-scrollbar.js', [], \ShopEngine::version(), true);
		wp_enqueue_script('shopengine-filter-js', \ShopEngine::plugin_url() . 'assets/js/filter.js', [], \ShopEngine::version(), true);
		wp_enqueue_script('shopengine-js', \ShopEngine::plugin_url() . 'assets/js/public.js', [], \ShopEngine::version(), true);


		wp_localize_script('shopengine-js', 'shopEngineApiSettings', [
			'resturl'    => get_rest_url(),
			'rest_nonce' => wp_create_nonce('wp_rest'),
		]);


		/**
		 * Registering libs css/js
		 *
		 */

		wp_register_style(
			'lib-sqv-css',
			\ShopEngine::plugin_url() . '/assets/sqv/smart-quick-view.css',
			[],
			\ShopEngine::version()
		);

		wp_register_script(
			'lib-sqv-js',
			\ShopEngine::plugin_url() . 'assets/sqv/smart-quick-view.js',
			['jquery', 'wc-single-product'],
			\ShopEngine::version(),
			true
		);
	}

	public function js_css_elementor() {
		wp_enqueue_style('shopnegine-panel-icon', \ShopEngine::plugin_url() . 'assets/css/shopengine-icon.css', false, \ShopEngine::version());

		if('shopengine-template' === get_post_type()):
			wp_enqueue_style('shopnegine-editor-css', \ShopEngine::plugin_url() . 'assets/css/editor.css', false, \ShopEngine::version());
		endif;
	}


	public function missing_woocommerce() {

		if(isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		if(file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {

			$btn['label'] = esc_html__('Activate WooCommerce', 'shopengine');
			$btn['url']   = wp_nonce_url('plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=all&paged=1', 'activate-plugin_woocommerce/woocommerce.php');

		} else {

			$btn['label'] = esc_html__('Install WooCommerce', 'shopengine');
			$btn['url']   = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce');
		}

		Utils\Notice::push(
			[
				'id'          => 'missing-woo',
				'type'        => 'error',
				'dismissible' => true,
				'btn'         => $btn,
				'message'     => sprintf(esc_html__('ShopEngine requires woocommerce Plugin, which is currently NOT RUNNING.', 'shopengine'), '4.1.0'),
			]
		);
	}


	public function missing_elementor() {

		if(isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		if(file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {

			$btn['label'] = esc_html__('Activate Elementor', 'shopengine');
			$btn['url']   = wp_nonce_url('plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php');

		} else {

			$btn['label'] = esc_html__('Install Elementor', 'shopengine');
			$btn['url']   = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
		}

		Utils\Notice::push(
			[
				'id'          => 'missing-elementor',
				'type'        => 'error',
				'dismissible' => true,
				'btn'         => $btn,
				'message'     => sprintf(esc_html__('ShopEngine requires Elementor version %1$s+, which is currently NOT RUNNING.', 'shopengine'), '3.0.0'),
			]
		);
	}


	public function failed_elementor_version() {

		$btn['label'] = esc_html__('Update Elementor', 'shopengine');
		$btn['url']   = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=elementor'), 'upgrade-plugin_elementor');

		Utils\Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => 'error',
				'dismissible' => true,
				'btn'         => $btn,
				'message'     => sprintf(esc_html__('ShopEngine requires Elementor version %1$s+, which is currently NOT RUNNING.', 'shopengine'), '3.0.0'),
			]
		);
	}


	public function flush_rewrites() {
		$form_cpt = new Core\Builders\Cpt();
		$form_cpt->flush_rewrites();
	}


	public static function instance() {
		if(!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
