<?php

namespace ShopEngine\Core\Settings;

use ShopEngine\Core\PageTemplates\Page_Templates;
use ShopEngine\Core\Template_Cpt;
use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

class Base {
	use Singleton;

	private $menu_link_part;


	/**
	 *
	 * @since 1.0.0
	 *
	 */
	public function init() {

		new Api();

		$this->menu_link_part = admin_url('edit.php?post_type=' . \ShopEngine\Core\Template_Cpt::TYPE);

		// check permission for manage user
		if(current_user_can('manage_options')) {
			add_action('admin_menu', [$this, 'menu_getting_started']);
			add_action('admin_menu', [$this, 'menu_others'], 100);
		}

		add_action('admin_enqueue_scripts', function () {

			if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] === \ShopEngine\Core\Template_Cpt::TYPE) {

				if(function_exists('wc_get_products') && !\ShopEngine\Core\Builders\Templates::has_simple_product()) {

					\ShopEngine\Core\Builders\Templates::create_wc_simple_product();
				}
			}

		}, 0);

		add_action('admin_head', [$this, 'admin_head_enqueue_scripts']);
		add_action('admin_enqueue_scripts', [$this, 'js_css_admin']);
		add_action('admin_footer', [$this, 'content']);
	}

	public function admin_head_enqueue_scripts() {
		echo "<script>
		jQuery(document).ready( function($) {  
			$('.toplevel_page_shopengine-settings').find('.wp-first-item').css({display:'none'});
			$('.shopengine_pro_aware').parent().attr('target','_blank');  
		});
		</script>";
	}

	public function js_css_admin() {

		wp_enqueue_style('shopengine-admin-style-common', \ShopEngine::plugin_url() . 'assets/css/admin-style-common.css', false, \ShopEngine::version());

		// get screen id
		$screen = get_current_screen();

		$cptName = \ShopEngine\Core\Template_Cpt::TYPE;

		$dashboardPage = 'toplevel_page_shopengine-settings';

		if(in_array($screen->id, ['edit-' . $cptName, 'shopengine_page_mt-form-settings', $dashboardPage])) {

			wp_enqueue_script('htm', \ShopEngine::plugin_url() . 'assets/js/htm.js', null, \ShopEngine::version(), true);

			wp_enqueue_script('shopengine-admin-js', \ShopEngine::plugin_url() . 'assets/js/app.js', ['htm', 'jquery', 'wp-element'], \ShopEngine::version(), true);

			// page template lists
			$page_templates = Page_Templates::instance()->getTemplates();

			wp_localize_script('shopengine-admin-js', 'shopengine_admin_var', [
				'version'             => \ShopEngine::version(),
				'package_type'        => \ShopEngine::package_type(),
				'license_status'      => \ShopEngine::license_status(),
				'cpt'                 => $cptName,
				'resturl'             => get_rest_url(),
				'adminurl'            => get_admin_url(),
				'siteurl'             => get_option('siteurl'),
				'rest_nonce'          => wp_create_nonce('wp_rest'),
				'plugin_url'          => \ShopEngine::plugin_url(),
				'pricing_page'        => \ShopEngine::landing_page(),
				'form_prefix'         => \ShopEngine::SHOPENGINE_PREFIX,
				'template_types'      => json_encode($page_templates),
				'elementor_installed' => did_action('elementor/loaded') ? 'yes' : 'no',
				'supported_builders'  => [
					\ShopEngine\Core\Builders\Action::EDIT_WITH_ELEMENTOR => 'Elementor',
					\ShopEngine\Core\Builders\Action::EDIT_WITH_GUTENBERG => 'Gutenberg',
				],
				'default_builder'     => did_action('elementor/loaded') ? \ShopEngine\Core\Builders\Action::EDIT_WITH_ELEMENTOR : \ShopEngine\Core\Builders\Action::EDIT_WITH_GUTENBERG,
				'license_activated_message' => sprintf(esc_html__('Congratulations! Your product is activated for "%s"', 'shopengine'), parse_url(home_url(), PHP_URL_HOST)),			
				'is_rtl'			=> is_rtl() ? 'true' : 'false',
			]);

			wp_enqueue_style('shopengine-admin-style', \ShopEngine::plugin_url() . 'assets/css/admin-style.css', false, \ShopEngine::version());
		}

		if($screen->id == 'edit-shopengine-entry' || $screen->id == 'shopengine-entry') {
			wp_enqueue_style('shopengine-ui', \ShopEngine::plugin_url() . 'assets/css/design-ui.css', false, \ShopEngine::version());
			wp_enqueue_script('shopengine-entry-script', \ShopEngine::plugin_url() . 'assets/js/admin-entry-script.js', [], \ShopEngine::version(), true);
		}
	}


	function menu_getting_started() {
		add_menu_page(
			esc_html__('ShopEngine', 'shopengine'),
			esc_html__('ShopEngine', 'shopengine'),
			'manage_options',
			'shopengine-settings',
			[$this, 'redirect_to_content'],
			\ShopEngine::plugin_url() . 'assets/images/icons/shopengine_icon_white.svg',
			'58.7'
		);

		add_submenu_page(
			'shopengine-settings',
			esc_html__('Getting Started', 'shopengine'),
			esc_html__('Getting Started', 'shopengine'),
			'manage_options',
			$this->menu_link_part . '#getting-started'
		);
	}

	public function menu_others() {
		add_submenu_page(
			'shopengine-settings',
			esc_html__('Modules', 'shopengine'),
			esc_html__('Modules', 'shopengine'),
			'manage_options',
			$this->menu_link_part . '#shopengine-modules'
		);

		add_submenu_page(
			'shopengine-settings',
			esc_html__('Widgets', 'shopengine'),
			esc_html__('Widgets', 'shopengine'),
			'manage_options',
			$this->menu_link_part . '#shopengine-widgets'
		);

		add_submenu_page(
			'shopengine-settings',
			esc_html__('Get Help', 'shopengine'),
			esc_html__('Get Help', 'shopengine'),
			'manage_options',
			$this->menu_link_part . '#shopengine-get-help'
		);

		// license activation & go premium menu links
		if(\ShopEngine::package_type() != 'free') { // is pro
			add_submenu_page(
				'shopengine-settings',
				'<span style="color: #49dd85;" class="shopengine_pro_license pro">' . esc_html__('License', 'shopengine') . '</span>',
				'<span style="color: #49dd85;" class="shopengine_pro_license pro">' . esc_html__('License', 'shopengine') . '</span>',
				'manage_options',
				$this->menu_link_part . '#shopengine-license'
			);
		} else { // is free
			add_submenu_page(
				'shopengine-settings',
				'<span style="color: #f9b015;" class="shopengine_pro_aware pro">' . esc_html__('Upgrade to Premium', 'shopengine') . '</span>',
				'<span style="color: #f9b015;" class="shopengine_pro_aware pro">' . esc_html__('Upgrade to Premium', 'shopengine') . '</span>',
				'manage_options',
				\ShopEngine::landing_page()
			);
		}
	}

	function redirect_to_content() {
		wp_redirect($this->menu_link_part . '#getting-started');
	}

	function content() {
		$screen = get_current_screen();

		if($screen->id == 'edit-' . Template_Cpt::TYPE) {
			include_once \ShopEngine::plugin_dir() . 'core/settings/screens/default.php';
		}
	}

}
