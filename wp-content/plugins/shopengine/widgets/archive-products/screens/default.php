<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 *
 * /woocommerce/templates/archive-product.php
 */

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_part_filter_by_match('woocommerce/content-product.php', 'templates/content-product.php');
\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();
\ShopEngine\Compatibility\Conflicts\Theme_Hooks::instance()->theme_conflicts__archive_products_widget_during_render();

$wrap_extra_class = sprintf('%1$s%2$s', 'shopengine-grid', ($shopengine_is_hover_details !== 'yes' && $shopengine_group_btns !== 'yes') ? ' shopengine-hover-disable' : '');

$editor_mode = ( \Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview() ) ;
?>
<div data-pagination="<?php echo esc_attr($shopengine_pagination_style) ?>"
     class="shopengine-archive-products <?php echo esc_attr($wrap_extra_class); ?>">
	<?php

	// add product description
	add_action('woocommerce_after_shop_loop_item_title', function () use ($shopengine_is_details, $shopengine_group_btns, $shopengine_is_hover_details) {
		if($shopengine_is_hover_details === 'yes') : ?>
            <div class="shopengine-product-description-footer">
		<?php endif;

		if($shopengine_is_details === 'yes') :
			?>
            <div class="shopengine-product-excerpt"> <?php
				the_excerpt();
				?> </div> <?php
		endif;

		if($shopengine_is_hover_details === 'yes') : ?>
			<?php if($shopengine_group_btns !== 'yes') : ?>
                <div class="shopengine-product-description-btn-group">
					<?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
			<?php endif; ?>
            </div> <?php
		endif;
	}, 40);

	$wp_query_args = ['post_type' => 'product'];

	// pagination next previous button label filter

	if($shopengine_pagination_style === 'numeric') {
		$control_args['prev_icon'] = '<i class="' . esc_attr($shopengine_pagination_prev_icon['value']) . '"></i>';
		$control_args['next_icon'] = '<i class="' . esc_attr($shopengine_pagination_next_icon['value']) . '"></i>';
	}

	if($shopengine_pagination_style === 'default') {
		$control_args['prev_icon'] = $shopengine_pagination_prev_text;
		$control_args['next_icon'] = $shopengine_pagination_next_text;
	}

	if($shopengine_pagination_style === 'load-more' || $shopengine_pagination_style === 'load-more-on-scroll') {
		$control_args['prev_icon'] = '';
		$control_args['next_icon'] = $shopengine_pagination_loadmore_text;
	}

	if(isset($control_args)) {
		add_filter('woocommerce_pagination_args', function ($args) use ($control_args) {
			$args['prev_text'] = $control_args['prev_icon'];
			$args['next_text'] = $control_args['next_icon'];

			return $args;
		});
	}

	$page_type = \ShopEngine\Widgets\Products::instance()->get_template_type_by_id(get_the_ID());
	if(in_array($page_type, ['archive', 'shop', 'search']) &&  $editor_mode) {

		global $wp_query, $post;
		$main_query = clone $wp_query;
		$main_post = clone $post;
		$wp_query = new \WP_Query($wp_query_args);
		wc_setup_loop(
			[
				'is_filtered'  => is_filtered(),
				'total'        => $wp_query->found_posts,
				'total_pages'  => $wp_query->max_num_pages,
				'per_page'     => $wp_query->get('posts_per_page'),
				'current_page' => max(1, $wp_query->get('paged', 1)),
			]
		);
	}

	$run_loop = $editor_mode ? true : woocommerce_product_loop() ;

	if( $editor_mode ) {

		if(empty(WC()->session)) {
			WC()->session = new WC_Session_Handler();
			WC()->session->init();
		}
	}


	if($run_loop) {

		do_action('woocommerce_before_shop_loop');

		woocommerce_product_loop_start();

		if(wc_get_loop_prop('total')) {
			while(have_posts()) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action('woocommerce_shop_loop');

				global $product;

				// Ensure visibility.
				if ( ! empty( $product ) &&  $product->is_visible() ) : ?>
					<li class="archive-product-container">
						<ul class="shopengine-archive-mode-grid">
							<li class="shopengine-archive-products__left-image">
								<a href="<?php echo get_the_permalink(); ?>">
									<?php echo woocommerce_get_product_thumbnail( get_the_id() ); ?>
								</a>
							</li>

							<?php wc_get_template_part('content', 'product');?>

						</ul>
					</li>
				<?php endif;
			}
		}

		woocommerce_product_loop_end();

		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action('woocommerce_after_shop_loop');

	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action('woocommerce_no_products_found');
	}

	if(in_array($page_type, ['archive', 'shop', 'search']) && $editor_mode) {
		$wp_query = $main_query;
		$post = $main_post;
		wp_reset_query();
		wp_reset_postdata();
	}
	?>
</div>
