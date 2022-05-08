<?php

namespace ShopEngine\Libs\Updater;

use ShopEngine\Libs\License\Helper;

defined('ABSPATH') || exit;

class Init {

	public function __construct() {

		$license_key = Helper::instance()->get_license();
		$license_key = explode('-', trim($license_key['key']));
		$license_key = !isset($license_key[0]) ? '' : $license_key[0];

		$plugin_dir_and_filename = '';

		$active_plugins = is_multisite() ? get_site_option('active_sitewide_plugins') : get_option('active_plugins');

		foreach($active_plugins as $active_plugin) {
			if(false !== strpos($active_plugin, 'shopengine-pro.php')) {
				$plugin_dir_and_filename = $active_plugin;
				break;
			}
		}

		if(!empty($plugin_dir_and_filename)) {

			new Plugin_Updater(
				\ShopEngine_Pro::account_url(),
				$plugin_dir_and_filename,
				[
					'version' => \ShopEngine_Pro::version(), // current version number.
					'license' => $license_key, // license key (used get_option above to retrieve from DB).
					'item_id' => \ShopEngine_Pro::product_id(), // id of this product in EDD.
					'author'  => \ShopEngine_Pro::author_name(), // author of this plugin.
					'url'     => home_url(),
				]
			);
		}
	}
}
