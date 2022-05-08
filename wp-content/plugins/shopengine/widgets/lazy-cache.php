<?php

namespace ShopEngine\Widgets;

use ShopEngine\Modules\Swatches\Swatches;

defined('ABSPATH') || exit;

trait Lazy_Cache {

	private $cache_objects;

	private function cache($query_type, $query_arg) {

		$cache_key = $this->generate_key_hash($query_type, $query_arg);

		if(isset($this->cache_objects[$cache_key])) {
			return $this->cache_objects[$cache_key];
		}

		switch($query_type) {
			default:
			case 'wc_get_products':
				$query_object = wc_get_products($query_arg);
				break;

			case 'wc_get_orders-woocommerce_my_account_my_orders_query':
				$query_object = wc_get_orders(
					apply_filters(
						'woocommerce_my_account_my_orders_query',
						$query_arg
					)
				);
				break;

			case 'wc_get_orders':
				$query_object = wc_get_orders($query_arg);
				break;

			case 'get_posts':
				$query_object = get_posts($query_arg);
				break;

			case 'wc_get_product':
				$query_object = wc_get_product($query_arg);
				break;

			case 'get_post_meta':
				$query_object = get_post_meta($query_arg[0], $query_arg[1], $query_arg[2]);
				break;

			case 'get_all_color_terms':
				$query_object = $this->get_custom_terms(Swatches::PA_COLOR, 'color');
				break;

			case 'get_all_image_terms':
				$query_object = $this->get_custom_terms(Swatches::PA_IMAGE, 'image');
				break;

			case 'get_all_label_terms':
				$query_object = $this->get_custom_terms(Swatches::PA_LABEL, 'label');
				break;
		}

		$this->cache_objects[$cache_key] = $query_object;

		return $query_object;

	}

	public function get_custom_terms($option_key, $key) {

		$attribute_taxonomies = wc_get_attribute_taxonomies();
		$taxonomy_terms = [];

		if(!empty($attribute_taxonomies)) {
			foreach($attribute_taxonomies as $tax) {
				if($option_key === $tax->attribute_type) {
					$attribute_name = wc_attribute_taxonomy_name($tax->attribute_name);
					if(taxonomy_exists($attribute_name)) {
						$taxonomy_terms[$tax->attribute_name] = get_terms($attribute_name, 'orderby=name&hide_empty=0');
					}
				}
			}
		}

		$terms = $this->array_flatten($taxonomy_terms);

		if(is_array($terms) && !empty($terms)) {
			foreach($terms as $term) {
				$term_id = $term->term_id;
				$meta_value = get_term_meta($term_id, $option_key, true);
				$term->{$key} = $meta_value;
			}
		}

		return $terms;
	}

	public function array_flatten($array) {
		if(!is_array($array)) {
			return false;
		}

		$result = [];
		foreach($array as $key => $value) {
			if(is_array($value)) {
				$result = array_merge($result, $this->array_flatten($value));
			} else {
				$result[$key] = $value;
			}
		}

		return $result;
	}

	public function get_cache_objects() {
		return $this->cache_objects;
	}

	private function generate_key_hash($string, $array) {
		return $string . md5(serialize($array));
	}
}
