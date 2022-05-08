<?php

namespace ShopEngine\Utils;

class Elementor_Data_Map {

	private $_el = [];

	public function get_elementor_data($post_id) {

		$dt = get_post_meta($post_id, '_elementor_data', true);

		return json_decode($dt);
	}

	public function get_widget_data($widget_name, $data = false, $post_id = null) {

		if($data === false && !empty($post_id)) {

			$data = $this->get_elementor_data($post_id);
		}

		if(!empty($data) && is_array($data)) {

			$this->_el = [];

			$this->search_el($data, $widget_name);

			return $this->_el;
		}

		return [];
	}

	private function search_el($data, $name) {

		if(!is_array($data)) {

			return;
		}

		foreach($data as $k => $v) {

			if(!empty($v->elements) && is_array($v->elements)) {

				$this->search_el($v->elements, $name);

			} else {

				if($v->elType == 'widget' && $v->widgetType == $name) {

					$this->_el[] = $v;
				}
			}
		}
	}
}
