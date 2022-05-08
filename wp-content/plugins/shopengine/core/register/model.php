<?php

namespace ShopEngine\Core\Register;

defined('ABSPATH') || exit;

class Model {

	private $db_key;
	private static $instance;

	public static function source($source = 'settings') {
		if(!self::$instance) {
			self::$instance = new self();
		}

		self::$instance->set_db_key($source);

		return self::$instance;
	}

	private function set_db_key($source) {
		$this->db_key = 'shopengine_db_' . $source;
	}

	public function get_option($key, $default = null) {

		$db = get_option($this->db_key, []);

		return isset($db[$key]) ? $db[$key] : $default;
	}

	public function set_option($key, $value) {

		$db = get_option($this->db_key);

		if(is_object($db)) {
			$db = (array)$db;
		}

		if(!is_array($db)){
			$db = [];
		}

		$db[$key] = $value;

		return update_option($this->db_key, $db);
	}

	public function delete_option($key) {

		$db = get_option($this->db_key, []);

		if(isset($db[$key])) {
			unset($db[$key]);
		}

		return true;
	}
}
