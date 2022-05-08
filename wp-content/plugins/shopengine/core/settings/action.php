<?php

namespace ShopEngine\Core\Settings;

defined('ABSPATH') || exit;

use ShopEngine\Core\Register\Module_List;
use ShopEngine\Core\Register\Widget_List;
use ShopEngine\Traits\Singleton;

/**
 * Action Class.
 * for post insert, update and get data.
 *
 * @since 1.0.0
 */
class Action
{
	use Singleton;

	/**
	 * Public function __construct.
	 * call function for all
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->response = [
			'saved'  => false,
			'status' => esc_html__("Something went wrong.", 'shopengine'),
			'data'   => [],
		];
	}


	/**
	 * Public function store.
	 * store data for post
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {

		$data = [
			'widgets'  => [],
			'modules'  => [],
			'userdata' => []
		];


		$data['widgets'] = Widget_List::instance()->get_list(true, 'unfiltered');
		$data['modules'] = Module_List::instance()->get_list(true, 'unfiltered');

		return $data;
	}

	/**
	 * Public function store.
	 * store data for post
	 *
	 * @since 1.0.0
	 */
	public function get_data() {

		$data = [
			'widgets'  => [],
			'modules'  => [],
			'userdata' => []
		];


		$data['widgets'] = Widget_List::instance()->get_list();
		$data['modules'] = Module_List::instance()->get_list();

		return $data;
	}
}