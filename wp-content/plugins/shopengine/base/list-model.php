<?php

namespace ShopEngine\Base;

defined('ABSPATH') || exit;

use ShopEngine\Core\Register\Model;

abstract class List_Model {

	private $unfiltered_list = [];
	private $full_list = [];
	private $active_list = [];
	private $inactive_list = [];
	protected $list_type;
	protected $generate_base_class = false;

	public function __construct() {

		$saved_list = Model::source('settings')->get_option($this->list_type, []);
		$raw_list   = apply_filters('shopengine/' . $this->list_type . '/list', $this->raw_list());

		foreach($raw_list as $name => $item) {

			if($item['package'] === 'pro-disabled') {
				$item['settings']             = [];
				$item['status']               = 'inactive';
				$this->full_list[$name]       = $item;
				$this->unfiltered_list[$name] = $item;
				$this->inactive_list[$name]   = $item;
				continue;
			}

			if(!isset($saved_list[$name]['status']) && isset($item['status'])) {
				$item['status'] = $item['status'];
			} else {
				$item['status'] = (isset($saved_list[$name]['status']) && $saved_list[$name]['status'] == 'inactive' ? 'inactive' : 'active');
			}

			/**
			 * Scenario considered :
			 * +Scenario 1 : with old database saved values, we added new module with settings
			 * +Scenario 2 : no database settings yet saved, very fresh installation
			 * +Scenario 3 : For some reason in future we removed/renamed/added some fields and the client has already database saved values
			 *
			 */

			if(!isset($item['path'])) {
				$item['path'] = \ShopEngine::{rtrim($this->list_type, 's') . '_dir'}() . $name . '/';
			}

			if($this->generate_base_class == true) {
				if(!isset($item['base_class'])) {
					$item['base_class'] = '\Elementor\ShopEngine_' . \ShopEngine\Utils\Helper::make_classname($name);
				}

				if(!isset($item['config_class'])) {
					$item['config_class'] = $item['base_class'] . '_Config';

					if(file_exists($item['path'] . '/' . $item['slug'] . '-config.php')) {
						require_once $item['path'] . '/' . $item['slug'] . '-config.php';
					}
				}
			}

			$item['categories'] = ['shopengine-general'];

			if(!empty($item['config_class']) && class_exists($item['config_class']) && method_exists($item['config_class'], 'get_categories')) {
				$item['categories'] = (new $item['config_class']())->get_categories();
			}

			$this->unfiltered_list[$name] = $item;

			$db    = isset($saved_list[$name]['settings']) ? $saved_list[$name]['settings'] : [];
			$local = isset($item['settings']) ? $item['settings'] : [];

			$item['settings'] = array_merge($local, $db);

			$this->full_list[$name] = $item;

			if($item['status'] == 'active') {
				$this->active_list[$name] = $item;
			} else {
				$this->inactive_list[$name] = $item;
			}
		}
	}

	public function is_widget_active($key): bool {

		return isset($this->active_list[$key]);
	}

	public function get_list($list = true, $filter_type = 'full') { // full|active|inactive
		if($list !== true && isset($this->full_list[$list])) {
			return $this->full_list[$list];
		}

		return $this->{$filter_type . '_list'};
	}

	public function get_settings($key): array {

		return isset($this->full_list[$key]['settings']) ? $this->full_list[$key]['settings'] : [];
	}

	public function get_active_settings($key): array {
		return $this->active_list[$key]['settings'] ?? [];
	}

	public function get_module($key): array {
		return $this->full_list[$key] ?? [];
	}

	private function __merge_values_only($local, $db_val) {

		foreach($local as $key => $item) {

			if(isset($item['value'])) {

				$local[$key]['value'] = isset($db_val[$key]['value']) ? $db_val[$key]['value'] : $item['value'];
			}
		}

		return $local;
	}

	abstract protected function raw_list();
}
