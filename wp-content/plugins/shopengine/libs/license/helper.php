<?php

namespace ShopEngine\Libs\License;

use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

/**
 * Allows plugins to use their own update API.
 *
 * @version 1.1.4
 */
class Helper {

	use Singleton;

	public function activate($key) {

		$data = [
			'key' => $key,
			'id'  => \ShopEngine_Pro::product_id(),
		];

		$response = $this->check_license($data);

		if(isset($response->validate) && $response->validate == 1) {

			update_option('__shopengine_oppai__', $response->oppai);
			update_option('__shopengine_license_key__', $response->key);

			$response->is_activated = true;

			return $response;
		}

		return $response;
	}

	public function deactivate() {

		delete_option('__shopengine_oppai__');
		update_option('__shopengine_license_key__', '');

		return true;
	}


	public function check_license($data = []) {

		if(strlen($data['key']) < 28) {
			$data['error']   = 'yes';
			$data['message'] = 'Invalid license key';

			return (object)$data;
		}

		$data['oppai']       = get_option('__shopengine_oppai__');
		$data['action']      = 'activate';
		$data['marketplace'] = \ShopEngine_Pro::store_name();
		$data['author_name'] = \ShopEngine_Pro::author_name();
		$data['v']           = \ShopEngine_Pro::version();

		$url = \ShopEngine_Pro::api_url() . 'license?' . http_build_query($data);

		$args = [
			'timeout'     => 60,
			'redirection' => 3,
			'httpversion' => '1.0',
			'blocking'    => true,
			'sslverify'   => true,
		];


		$res = wp_remote_get($url, $args);

		return (object)json_decode((string)$res['body']);
	}

	public function status() {

		$cached = wp_cache_get('shopengine_pro__license_status');

		if(false !== $cached) {
			return $cached;
		}

		$oppai  = get_option('__shopengine_oppai__', '');
		$key    = get_option('__shopengine_license_key__', '');
		$status = 'invalid';

		if($oppai != '' && $key != '') {
			$status = 'valid';
		}

		wp_cache_set('shopengine_pro__license_status', $status);

		return $status;
	}

	public function get_license() {

		$cached = wp_cache_get('shopengine_pro__license_key');

		if(false !== $cached) {
			return $cached;
		}

		$oppai = get_option('__shopengine_oppai__');
		$key   = get_option('__shopengine_license_key__');

		$license = [
			'checksum' => $oppai,
			'key'      => $key,
		];

		wp_cache_set('shopengine_pro__license_key', $license);

		return $license;
	}
}
