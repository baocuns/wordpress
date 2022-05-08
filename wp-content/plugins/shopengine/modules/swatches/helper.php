<?php

namespace ShopEngine\Modules\Swatches;

defined('ABSPATH') || exit;


class Helper
{

	public static function get_tax_attribute($taxonomy) {

		global $wpdb;

		$attr = substr($taxonomy, 3);
		$attr = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = %s", $attr));

		return $attr;
	}


	public static function get_dummy() {

		return WC()->plugin_url() . '/assets/images/placeholder.png';
	}
}
