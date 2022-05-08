<?php

namespace ShopEngine\Widgets\Init;

use ShopEngine\Base\Api;

class Route extends Api
{

	public function config() {

		$this->prefix = 'widgets_partials';
		$this->param = "";
	}

	public function get_filter_cat_products() {

		$data = $this->request->get_params();

		$products = $data['products'];
		$settings = isset($data['settings']) ? $data['settings'] : null;

		if(empty($products)) {

			echo "<p class='error'>" . esc_html__('No products were found.', 'shopengine') . "</p>";

			exit();
		}

		$args = array(
			'post_type'      => 'product',
			'post__in'       => $products,
			'posts_per_page' => 50
		);


		$query = new \WP_Query($args);

		if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();

			$default_content = [
				'image'     => 0,
				'category'  => 0,
				'title'     => 0,
				'rating'    => 0,
				'price'     => 0,
				'description' => 0,
				'buttons'     => 0,
		  ];



				$content =  (!empty($view) ? $view : $default_content);
				asort($content, SORT_NUMERIC);

				if( $settings['shopengine_is_cats'] != 'yes' ) unset($content['category']);
				if( $settings['shopengine_is_details'] != 'yes' ) {
					unset($content['description']);
				}
				if( $settings['shopengine_is_product_rating'] != 'yes' ) unset($content['rating']);


				?> <div class='shopengine-single-product-item'> <?php
					foreach($content as $key => $value) {
						$function = '_product_' .  $key;
						\ShopEngine\Utils\Helper::$function($settings);
					}
				?> </div> <?php
				
			endwhile;
		endif;

		wp_reset_postdata();

		exit();
	}

	public function post_checkout_login() {
		$data = $this->request->get_params();
		if(isset($data['rememberme'])) {
			$data['rememberme'] = $data['rememberme'] == 'true' ? true : false;
		}
		$user = wp_signon($data);
		if(is_wp_error($user)) {
			return new \WP_Error('failed_login', $user->get_error_message(), ['status' => 404]);
		}
		return true;
	}
}
