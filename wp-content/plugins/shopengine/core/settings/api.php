<?php
namespace ShopEngine\Core\Settings;

use ShopEngine\Core\Register\Model;

defined('ABSPATH') || exit;

/**
 * Class Api
 *
 * @package ShopEngine\Core\Builders
 */
class Api extends \ShopEngine\Base\Api {

	public function config() {

		$this->prefix = 'settings';
		$this->param  = "";
	}


	public function post_save() {

		$data = json_decode($this->request->get_body(), true);

		if(!empty($data['widgets'])) {

			Model::source('settings')->set_option('widgets', $data['widgets']);
		}

		if(!empty($data['modules'])) {

			Model::source('settings')->set_option('modules', $data['modules']);
		}

		if(!empty($data['userdata'])) {

			Model::source('settings')->set_option('userdata', $data['userdata']);
		}

		do_action('shopengine/core/settings/on_save');

		return [
			'status' => 'success',
			'message' => esc_html__('settings saved successfully.', 'shopengine'),
		];
	}


	public function get_fields() {
		$fields = array_merge(
			Action::instance()->get_fields(), 
			['sample_designs' => \ShopEngine\Core\Sample_Designs\Base::instance()->get_designs()]
		);

		return apply_filters('shopengine/core/settings/return_fields', $fields);
	}

	public function get_data() {
		$data = Action::instance()->get_data();

		return apply_filters('shopengine/core/settings/return_data', $data);
	}
	
	public function get_categories() {

		$data = $this->request->get_params();

		$query_args = [
            'taxonomy'      => ['product_cat'], // taxonomy name
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 10
        ];

		if(isset($data['only_parent'])){
			$query_args['parent'] = 0;
		}
		
		if(isset($data['ids'])){
            $ids = explode(',', $data['ids']);
            $query_args['include'] = $ids;
        }
        if(isset($data['s'])){
            $query_args['name__like'] = $data['s'];
        }

		$product_cat = get_terms($query_args);
		$product_categories = [];
		foreach($product_cat as $category) {
			$product_categories[$category->term_id] = $category->name;
		}
		return [
			'status' => 'success',
			'result' => $product_categories,
			'message' => esc_html__('categories fetched', 'shopengine')
		];
	}
}
