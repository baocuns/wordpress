<?php

namespace ShopEngine\Widgets;


class Prod_Short_Code extends \WC_Shortcode_Products {

	public function __construct($settings = array(), $type = 'products') {

		$this->settings = $settings;
		$this->type     = $type;

		$this->attributes = $this->parse_attributes([
			'columns'  => $settings['shopengine_columns'],
			'rows'     => $settings['shopengine_rows'],
			'paginate' => $settings['shopengine_paginate'],
			'cache'    => false,
		]);

		$this->query_args = $this->parse_query_args();
	}


	protected function parse_query_args() {

		$query_args = [
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => false === wc_string_to_bool($this->attributes['paginate']),
		];

		$settings = $this->settings;

		if($settings['shopengine_paginate'] === 'yes') {

			$page = empty( $_GET['product-page'] ) ? 1 : absint($_GET['product-page']);

			if ($page > 1) {
				$query_args['paged'] = $page;
			}

			$ord_arg = WC()->query->get_catalog_ordering_args();

			$query_args['orderby'] = $ord_arg['orderby'];
			$query_args['order']   = $ord_arg['order'];
		}


		$query_args['fields']         = 'ids';
		$query_args['post_type']      = 'product';
		$query_args['posts_per_page'] = intval($settings['shopengine_columns'] * $settings['shopengine_rows']);


		return $query_args;
	}


	protected function get_query_results() {

		$results = parent::get_query_results();

		return $results;
	}
}