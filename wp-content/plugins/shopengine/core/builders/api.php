<?php

namespace ShopEngine\Core\Builders;

defined('ABSPATH') || exit;

/**
 * Class Api
 *
 * @package ShopEngine\Core\Builders
 */
class Api extends \ShopEngine\Base\Api {

	public function config() {

		$this->prefix = 'template';
		$this->param  = "/(?P<id>\w+)";
	}


	public function post_add() {

		if(!current_user_can('install_plugins')) {

			return [
				'saved'  => false,
				'status' => esc_html__("Not enough permission.", 'shopengine'),
				'data'   => [],
			];
		}

		$form_id = intval($this->request['id']);

		$form_setting = (array)json_decode($this->request->get_body());

		return Action::instance()->store($form_id, $form_setting);
	}


	public function get_getdata() {

		if(!current_user_can('install_plugins')) {

			return [
				'saved'  => false,
				'status' => esc_html__("Not enough permission.", 'shopengine'),
				'data'   => [],
			];
		}

		$post_id = intval($this->request['id']);

		return Action::instance()->get_all_data($post_id);
	}
}
