<?php

namespace ShopEngine\Core\Builders;

use ShopEngine\Base\Common;
use ShopEngine\Core\Export_Import\Export;
use ShopEngine\Core\Export_Import\Import;
use ShopEngine\Core\PageTemplates\Page_Templates;
use ShopEngine\Core\Template_Cpt;
use ShopEngine\Traits\Singleton;
use ShopEngine\Utils\Elementor_Data_Map;

defined('ABSPATH') || exit;

class Base extends Common {

	use Singleton;

	// $api variable call for Cpt Class Instance
	public $form;

	// $api variable call for Api Class Instance
	public $api;

	public function get_dir() {

		return dirname(__FILE__);
	}


	/**
	 *
	 * @since 1.0.0
	 *
	 */
	public function init() {

		$this->api = new Api();

		#Registering custom post type
		Template_Cpt::instance()->init();

		$cpt_type = Template_Cpt::TYPE;

		#All hooks
		Hooks::instance()->init();

		add_filter("theme_{$cpt_type}_templates", [$this, 'add_page_templates'], 999, 4);
		add_filter("elementor/document/urls/wp_preview", [$this, 'change_preview_editor_url'], 999, 2);


		add_action('wp', [Page_Templates::instance(), 'init'], 999);

		add_filter('woocommerce_checkout_fields', [$this, 'disabling_fields'], 999);

		(new Export())->init();
		(new Import())->init();
	}

	public function change_preview_editor_url($url, $document) {
		$post_id  = $document->get_main_id();
		$template = \ShopEngine\Core\Builders\Templates::get_registered_template_data($post_id);

		if(empty($template) || !isset($template['url']) || get_post_type($post_id) !== Template_Cpt::TYPE) {
			return $url;
		}

		$param = [
			'shopengine_template_id' => $post_id,
			'preview_nonce'          => wp_create_nonce('template_preview_' . $post_id),
			'change_template'        => '1',
		];

		$url = \ShopEngine\Utils\Helper::add_to_url($template['url'], $param);


		return $url;
	}

	public function add_page_templates($page_templates, $wp_theme, $post) {

		unset($page_templates['elementor_theme']);

		$page_templates['shopengine_canvas_tpl']     = esc_html__('Shopengine Canvas', 'shopengine');
		$page_templates['shopengine_full_width_tpl'] = esc_html__('Shopengine Full width', 'shopengine');

		return $page_templates;
	}

	public function disabling_fields($fields) {

		// checkout page
		// - is any checkout template active ?
		// - - then it is overriding the template
		// - - - then add the filter

		if(is_checkout()) {

			$template_id = $this->get_template_id('checkout');

			if(!empty($template_id)) {

				$current_page_id = get_the_ID();
				$mapper          = new Elementor_Data_Map();

				$dt  = $mapper->get_elementor_data($template_id);
				$els = $mapper->get_widget_data('shopengine-checkout-form-billing', $dt);

				if(!empty($els[0]->settings)) {

					$obj = $els[0]->settings;
					unset($els);

					if(!empty($obj->shopengine_hide_billing_first_name_field)) {

						unset($fields['billing']['billing_first_name']);
					}

					if(!empty($obj->shopengine_hide_billing_last_name_field)) {

						unset($fields['billing']['billing_last_name']);
					}

					if(!empty($obj->shopengine_hide_billing_company_field)) {

						unset($fields['billing']['billing_company']);
					}

					if(!empty($obj->shopengine_hide_billing_country_field)) {

						unset($fields['billing']['billing_country']);
					}

					if(!empty($obj->shopengine_hide_billing_address_1_field)) {

						unset($fields['billing']['billing_address_1']);
					}

					if(!empty($obj->shopengine_hide_billing_address_2_field)) {

						unset($fields['billing']['billing_address_2']);
					}

					if(!empty($obj->shopengine_hide_billing_city_field)) {

						unset($fields['billing']['billing_city']);
					}

					if(!empty($obj->shopengine_hide_billing_state_field)) {

						unset($fields['billing']['billing_state']);
					}

					if(!empty($obj->shopengine_hide_billing_postcode_field)) {

						unset($fields['billing']['billing_postcode']);
					}

					if(!empty($obj->shopengine_hide_billing_phone_field)) {

						unset($fields['billing']['billing_phone']);
					}

					if(!empty($obj->shopengine_hide_billing_email_field)) {

						unset($fields['billing']['billing_email']);
					}
				}

				$els = $mapper->get_widget_data('shopengine-checkout-form-shipping', $dt);

				if(!empty($els[0]->settings)) {

					$obj = $els[0]->settings;
					unset($els);

					if(!empty($obj->shopengine_hide_billing_first_name_field)) {

						unset($fields['shipping']['shipping_first_name']);
					}

					if(!empty($obj->shopengine_hide_shipping_last_name_field)) {

						unset($fields['shipping']['shipping_last_name']);
					}

					if(!empty($obj->shopengine_hide_shipping_company_field)) {

						unset($fields['shipping']['shipping_company']);
					}

					if(!empty($obj->shopengine_hide_shipping_country_field)) {

						unset($fields['shipping']['shipping_country']);
					}

					if(!empty($obj->shopengine_hide_shipping_address_1_field)) {

						unset($fields['shipping']['shipping_address_1']);
					}

					if(!empty($obj->shopengine_hide_shipping_address_2_field)) {

						unset($fields['shipping']['shipping_address_2']);
					}

					if(!empty($obj->shopengine_hide_shipping_city_field)) {

						unset($fields['shipping']['shipping_city']);
					}

					if(!empty($obj->shopengine_hide_shipping_state_field)) {

						unset($fields['shipping']['shipping_state']);
					}

					if(!empty($obj->shopengine_hide_shipping_postcode_field)) {

						unset($fields['shipping']['shipping_postcode']);
					}
				}

			} else {

				// var_dump('ohh....... no checkout template is active!');

			}
		}


		return $fields;
	}

	public function get_template_id($type) {

		return \ShopEngine\Core\Builders\Templates::get_registered_template_id($type);
	}
}
