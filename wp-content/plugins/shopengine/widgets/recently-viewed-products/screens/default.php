<div class="shopengine-recently-viewed-products">
    <div class="recent-viewed-product-list">
		<?php

		if (!empty($_COOKIE['shopengine_recent_viewed_product'])) {

			$product_ids = array_unique(explode(',', $_COOKIE['shopengine_recent_viewed_product']));

			global $product;
			
			$product_id = $product->get_id();

			$cookie_array_key = array_search($product_id, $product_ids);

			if (false !== $cookie_array_key) {
				unset($product_ids[$cookie_array_key]);
			}

			$product_limit = isset($settings['products_per_page']) ? $settings['products_per_page'] : 6;

			if (isset($settings['product_order']) && $settings['product_order'] == 'ASC') {

				$product_ids = array_reverse($product_ids);

				if($product_limit < count($product_ids)) {
					$product_ids = array_slice($product_ids, 0, $product_limit);
				}

			} else {

				$total_product = count($product_ids);

				if($product_limit < $total_product) {
					$product_ids = array_slice($product_ids, $total_product - $product_limit, $total_product - 1);
				}
			}
		}

		$editor_mode = (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview());

		$args        = [
			'post_type'      => 'product',
			'post__in'       => isset($product_ids) ? $product_ids : [],
			'orderby'        => 'post__in'
		];

		$view = ['image','title','price','buttons'];

		if($editor_mode){

			global $wp_query, $post;
			$main_query = clone $wp_query;
			$main_post = clone $post;
		}

		$query = new WP_Query($args);

		if($query->have_posts()) :
			while($query->have_posts()) :
				$query->the_post();

				$default_content = [
					'image',
					'category',
					'title',
					'rating',
					'price',
					'description',
					'buttons'
				];

				$content = (!empty($view) ? $view : $default_content);
				asort($content, SORT_NUMERIC);
				?>
                <div class='shopengine-single-product-item'>
					<?php
					foreach($content as $key => $value) {
						$function = '_product_' . (is_numeric($value) ? $key : $value);
						\ShopEngine\Utils\Helper::$function($settings);
					}

					if(!empty($settings['counter_position']) && $settings['counter_position'] == 'footer') {
						\ShopEngine\Utils\Helper::_product_sale_end_date($settings, esc_html__('Ends in ', 'shopengine'));
					}
					?>

                </div>
			<?php
			endwhile;
		endif;

		if($editor_mode) {

			$wp_query = $main_query;
			$post = $main_post;
			wp_reset_query();
			wp_reset_postdata();

			unset($main_query, $main_post);
		}

		?>
    </div>
</div>
