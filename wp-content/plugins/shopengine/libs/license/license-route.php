<?php

namespace ShopEngine\Libs\License;


class License_Route extends \ShopEngine\Base\Api {

	public function config() {

		$this->prefix = 'license';
		$this->param  = "";
	}


	/**
	 * /shopengine-builder/v1/license/deactive
	 *
	 * http://localhost/shopengine/pro/wp-json/shopengine-builder/v1/license/post_deactive
	 */
	public function post_deactive() {

		$res = Helper::instance()->deactivate();

		//wp_redirect('https://account.wpmet.com/?wpmet-screen=products'); exit;

		return [
			'success' => 'ok',
			'msg'     => esc_html__('Successfully deactivated', 'shopengine'),
		];
	}

	/**
	 * /shopengine-builder/v1/license/activate
	 *
	 * http://localhost/shopengine/pro/wp-json/shopengine-builder/v1/license/activate
	 */
	public function post_activate() {

		$data = json_decode($this->request->get_body(), true);

		if(empty($data['license_key'])) {

			return [
				'success' => 'danger',
				'dt'      => $data,
				'msg'     => esc_html__('License key is empty', 'shopengine'),
			];
		}

		$res = Helper::instance()->activate($data['license_key']);

		if(!empty($res->is_activated)) {

			return [
				'success' => 'ok',
				'dt'      => $res,
				'msg'     => esc_html__('Successfully activated', 'shopengine'),
			];
		}

		if(!empty($res->error)) {
			return [
				'success' => 'danger',
				'msg'     => $res->message,
			];
		}

		return [
			'success' => 'danger',
			'msg'     => esc_html__('Unsupported pro version', 'shopengine'),
		];
	}

	/**
	 * /shopengine-builder/v1/license/test
	 *
	 * http://localhost/shopengine/pro/wp-json/shopengine-builder/v1/license/test
	 */
	public function get_test() {

		echo 'hello....';
	}
}
