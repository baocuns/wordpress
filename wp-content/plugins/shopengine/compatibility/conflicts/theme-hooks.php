<?php

namespace ShopEngine\Compatibility\Conflicts;


use ShopEngine\Traits\Singleton;

class Theme_Hooks {

	use Singleton;

	public function force_load_woocommerce_css($styles) {

		if(!isset($styles['woocommerce-layout'])) {

			$styles['woocommerce-layout'] = [
				'src'     => WC()->plugin_url() . '/assets/css/woocommerce-layout.css',
				'deps'    => '',
				'version' => \Automattic\Jetpack\Constants::get_constant('WC_VERSION'),
				'media'   => 'all',
				'has_rtl' => true,
			];
		}


		if(!isset($styles['woocommerce-general'])) {

			$styles['woocommerce-general'] = [
				'src'     => WC()->plugin_url() . '/assets/css/woocommerce.css',
				'deps'    => '',
				'version' => \Automattic\Jetpack\Constants::get_constant('WC_VERSION'),
				'media'   => 'all',
				'has_rtl' => true,
			];
		}


		return $styles;
	}


	public function theme__conflicts__shop_and_archive() {
		/**
		 * Common in multiple theme
		 *
		 */
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');


		/*******************************************************
		 * Storefront theme hook reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'storefront_sorting_wrapper', 9);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'storefront_sorting_wrapper_close', 31);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30);
		$this->remove_action_if_exists('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);

		/**
		 * End of Storefront theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * xStore theme hook reverting in shop & archive page
		 *
		 ******************************************************/

		$this->remove_action_if_exists('woocommerce_sale_flash', 'etheme_woocommerce_sale_flash', 20);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'etheme_grid_list_switcher', 35);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'etheme_products_per_page_select', 37);
		$this->remove_action_if_exists('woocommerce_after_shop_loop', 'woocommerce_result_count', 5);

		/**
		 * End of xStore theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Astra theme hook reverting...
		 *
		 ******************************************************/

		if(has_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper') === false) {
			add_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		}

		if(has_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end') === false) {
			add_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		}

		if(has_action('woocommerce_sidebar', 'woocommerce_get_sidebar') === false) {
			add_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title') === false) {
			add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		}

		if(has_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price') === false) {
			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		}

		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash') === false) {
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		}

		if(has_action('woocommerce_before_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_start') !== false) {
			remove_action('woocommerce_before_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_start', 6);
		}

		if(has_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash') !== false) {
			remove_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_end') !== false) {
			remove_action('woocommerce_after_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_end', 8);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'astra_woo_shop_out_of_stock') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'astra_woo_shop_out_of_stock', 8);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart') === false) {
			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'astra_woo_woocommerce_shop_product_content') !== false) {
			remove_action('woocommerce_after_shop_loop_item', 'astra_woo_woocommerce_shop_product_content');
		}

		/**
		 * End of astra theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Hestia theme hook reverting...
		 *
		 ******************************************************/
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_thumbnail', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'hestia_woocommerce_before_shop_loop_item', 10);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'hestia_woocommerce_after_shop_loop_item', 20);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_title', 10);


		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail') === false) {
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		}

		if(has_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open') === false) {
			add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close') === false) {
			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart') === false) {
			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title') === false) {
			add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		}


		if(has_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price') === false) {
			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		}

		/**
		 * End of hestia theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Flatsome theme hook reverting...
		 *
		 ******************************************************/


		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'flatsome_woocommerce_shop_loop_category', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash');
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woocommerce_result_count');
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

		/**
		 * End of Flatsome theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Neve theme hook reverting...
		 *
		 ******************************************************/


		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\Neve\Views\Product_Layout', 'card_content_wrapper');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\Neve\Views\Product_Layout', 'wrapper_close_div');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\Neve\Views\Product_Layout', 'product_image_wrap');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\Neve\Views\Product_Layout', 'out_of_stock_badge');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\Neve\Views\Product_Layout', 'wrapper_close_div');


		/**
		 * End of Neve theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Woodmart theme hook reverting in shop & archive
		 *
		 ******************************************************/

		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail');
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woodmart_products_per_page_select', 25);

		/**
		 * End of Woodmart theme hook reverting in shop & archive
		 ******************************************************/


		/*******************************************************
		 * OceanWP theme hook reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'add_shop_loop_div');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'close_shop_loop_div');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'grid_list_buttons');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'result_count');

		$this->add_action_if_not_exists('woocommerce_before_shop_loop', 'woocommerce_result_count');

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');

		/**
		 * End of OceanWP theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Porto theme hook reverting...
		 *
		 ******************************************************/

		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail') !== false) {
			remove_action('woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1);

		}

		if(has_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title');
		}

		if(has_action('woocommerce_before_shop_loop', 'woocommerce_pagination') !== false) {
			remove_action('woocommerce_before_shop_loop', 'woocommerce_pagination', 50);
		}

		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail') === false) {
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		}

		$this->remove_action_if_exists( 'woocommerce_before_shop_loop', 'porto_grid_list_toggle', 70 );
		/*******************************************************
		 * End of porto theme hook reverting...
		 *
		 ******************************************************/

		/*******************************************************
		 * Electro theme hook reverting in shop & archive page
		 *
		 ******************************************************/


		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'electro_shop_control_bar', 11);
		$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link', 90);
		$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'redux_apply_catalog_mode_for_product_loop', 85);

		$this->remove_action_if_exists('electro_product_item_hover_area', 'electro_loop_action_buttons', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_outer', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close', 145);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close', 150);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'electro_wc_loop_title', 10);
		$this->remove_action_if_exists('woocommerce_get_price_html', 'electro_wrap_price_html', 90);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

		// Storefront Theme
		$this->remove_action_if_exists('woocommerce_before_main_content', 'storefront_before_content', 10 );
		$this->remove_action_if_exists('woocommerce_after_main_content', 'storefront_after_content', 10 );
	}

	/**
	 * This method is called from badge module.
	 *
	 */
	public function theme_conflicts__shop_and_archive_for_badge_module() {

		$this->remove_action_if_exists( 'woocommerce_sale_flash', 'woodmart_product_label', 10 );
	}

	public function theme__conflicts__single_page() {

		/**
		 * Woodmart theme dequeueing this so we are enqueueing again.
		 */
		wp_enqueue_script('flexslider');


		/*******************************************************
		 * Woodmart theme hook reverting...
		 *
		 ******************************************************/

		if(has_action('woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail') !== false) {
			remove_action('woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail', 10);
		}

		if(has_action('woocommerce_sale_flash', 'woodmart_product_label') !== false) {
			remove_filter('woocommerce_sale_flash', 'woodmart_product_label', 10);
		}

		$this->remove_action_if_exists( 'woocommerce_product_tabs', 'woodmart_custom_product_tabs' );
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');

		/**
		 * End of Woodmart theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Astra theme hook reverting...
		 *
		 ******************************************************/

		if(has_action('woocommerce_before_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_start') !== false) {
			remove_action('woocommerce_before_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_start', 6);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_end') !== false) {
			remove_action('woocommerce_after_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_end', 8);
		}

		if(has_action('woocommerce_after_shop_loop_item', 'astra_woo_woocommerce_shop_product_content') !== false) {
			remove_action('woocommerce_after_shop_loop_item', 'astra_woo_woocommerce_shop_product_content');
		}

		if(has_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart') === false) {

			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
		}

		if(has_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating') === false) {

			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title') === false) {

			add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		}

		if(has_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price') === false) {

			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		}

		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash') === false) {

			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		}

		if(has_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash') !== false) {

			remove_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9);
		}

		/**
		 * End of Astra theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Electro theme hook reverting...
		 *
		 ******************************************************/

		if(has_filter('woocommerce_sale_flash', 'electro_get_sale_flash') !== false) {
			remove_filter('woocommerce_sale_flash', 'electro_get_sale_flash', 20);
		}

		if(has_filter('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link') !== false) {
			remove_filter('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link', 90);
		}

		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner');

		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		$this->remove_action_if_exists('electro_product_item_hover_area', 'electro_loop_action_buttons', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_outer', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close', 145);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close', 150);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);
		$this->remove_action_if_found_14('woocommerce_product_tabs', 'Electro_WooCommerce', 'modify_product_tabs');
		/**
		 * End of Electro theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * flatsome theme hook reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'flatsome_woocommerce_shop_loop_category', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash');

		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');


		/**
		 * End of flatsome theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Porto theme hook reverting...
		 *
		 ******************************************************/

		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail') !== false) {
			remove_action('woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1);

		}

		if(has_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100);
		}

		if(has_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title') !== false) {
			remove_action('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title');
		}

		if(has_action('woocommerce_before_shop_loop', 'woocommerce_pagination') !== false) {
			remove_action('woocommerce_before_shop_loop', 'woocommerce_pagination', 50);
		}

		if(has_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail') === false) {
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		}

		$this->remove_action_if_exists( 'woocommerce_after_add_to_cart_button', 'porto_view_cart_after_add', 35 );
		/**
		 * End of porto theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Neve theme hook reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\Neve\Views\Product_Layout', 'card_content_wrapper');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\Neve\Views\Product_Layout', 'wrapper_close_div');

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\Neve\Views\Product_Layout', 'product_image_wrap');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\Neve\Views\Product_Layout', 'out_of_stock_badge');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\Neve\Views\Product_Layout', 'wrapper_close_div');


		/**
		 * End of Neve theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * xStore theme hook reverting...
		 *
		 ******************************************************/

		if(has_filter('woocommerce_sale_flash', 'etheme_woocommerce_sale_flash') !== false) {
			remove_filter('woocommerce_sale_flash', 'etheme_woocommerce_sale_flash', 20);
		}

		/**
		 * End of xStore theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Storefront theme hook reverting...
		 *
		 ******************************************************/

		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6);

		/**
		 * End of Storefront theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Hestia theme hook reverting...
		 *
		 ******************************************************/

		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 20);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_thumbnail', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'hestia_woocommerce_before_shop_loop_item', 10);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'hestia_woocommerce_after_shop_loop_item', 20);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

		/**
		 * End of hestia theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * OceanWP theme hook reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');

		/**
		 * End of hestia theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Porto theme hook reverting
		 ******************************************************/
		$this->remove_action_if_exists('woocommerce_after_single_product_summary', 'porto_woocommerce_output_related_products', 20);
		$this->remove_action_if_exists('porto_after_content_bottom', 'porto_woocommerce_output_related_products', 8);
		/**
		 * End of Porto theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Astra theme hook reverting
		 ******************************************************/
		$this->remove_action_if_found_14('woocommerce_product_get_rating_html', '\Astra_Woocommerce', 'rating_markup');
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		/**
		 * End of Astra theme hook reverting
		 ******************************************************/

	}

	public function theme_conflicts_in_editor__product_tabs_widget() {

		// Electro Theme
		$this->remove_action_if_found_14('woocommerce_product_tabs', 'Electro_WooCommerce', 'modify_product_tabs');
	}


	public function theme_conflicts_cart_page() {
		// common
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		/*******************************************************
		 * OceanWP theme cart page hook for cross-sell reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_found_14('ocean_after_product_entry_slider', '\OceanWP_WooCommerce_Config', 'quick_view_button');
		$this->remove_action_if_found_14('ocean_after_product_entry_image', '\OceanWP_WooCommerce_Config', 'quick_view_button');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');


		/**
		 * End of OceanWP theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Astra theme cart page hook for cross-sell reverting...
		 *******************************************************/

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_start', 6);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'astra_woo_shop_thumbnail_wrap_end', 8);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'astra_woo_woocommerce_shop_product_content');
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		$this->remove_action_if_found_14('woocommerce_product_get_rating_html', '\Astra_Woocommerce', 'rating_markup' );
		/**
		 * End of Astra theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Hestia theme cart page hook for cross-sell reverting...
		 *******************************************************/

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_thumbnail', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'hestia_woocommerce_before_shop_loop_item', 10);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'hestia_woocommerce_after_shop_loop_item', 20);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_title', 10);

		/**
		 * End of Hestia theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Porto theme cart page hook for cross-sell reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100);
		$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title');

		/**
		 * End of Porto theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Woodmart theme cart page hook for cross-sell reverting...
		 *******************************************************/

		$this->remove_action_if_exists( 'woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail', 10);

		/**
		 * End of Woodmart theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Flatsome theme hook reverting
		 ******************************************************/
		$this->add_action_if_not_exists( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		$this->remove_action_if_exists( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display'  );
		/**
		 * End of Flatsome theme hook reverting
		 ******************************************************/

	}


	public function theme_conflicts_empty_cart_page() {

		$this->remove_action_if_exists('woocommerce_cart_is_empty', 'woodmart_wc_empty_cart_message', 10);
		$this->remove_action_if_exists('woocommerce_cart_is_empty', 'woodmart_empty_cart_text', 20);
		$this->add_action_if_not_exists('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);

		add_filter('woocommerce_cart_product_cannot_be_purchased_message', function () {
			return;
		}, 10);
	}


	public function theme_conflicts_in_elementor_editor_cross_sells() {

		/*******************************************************
		 * OceanWP theme cart page hook for cross-sell reverting..
		 ******************************************************/

		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		$this->add_action_if_not_exists('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');

		$this->remove_action_if_found_14('woocommerce_cart_collaterals', '\OceanWP_WooCommerce_Config', 'cross_sell_display');
		$this->remove_action_if_found_14('woocommerce_after_single_product_summary', '\OceanWP_WooCommerce_Config', 'upsell_display');
		$this->remove_action_if_found_14('ocean_after_product_entry_image', '\OceanWP_WooCommerce_Config', 'quick_view_button');
		$this->remove_action_if_found_14('ocean_after_product_entry_slider', '\OceanWP_WooCommerce_Config', 'quick_view_button');

		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_before_template_part', '\OceanWP_WooCommerce_Config', 'before_template_part');
		$this->add_action_if_not_exists('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		/**
		 * End of OceanWP theme hook reverting
		 ******************************************************/



		/*******************************************************
		 * Porto theme cart page hook for cross-sell reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_exists( 'woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10 );
		$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1 );
		$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100 );
		$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title' );
		$this->remove_action_if_exists( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 50 );
		$this->add_action_if_not_exists( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

		/**
		 * End of Porto theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Woodmart theme cart page hook for cross-sell reverting...
		 *******************************************************/

		$this->remove_action_if_exists( 'woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail', 10 );

		/**
		 * End of Woodmart theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Astra theme hook reverting
		 ******************************************************/
		$this->remove_action_if_found_14( 'woocommerce_product_get_rating_html', '\Astra_Woocommerce', 'rating_markup' );
		$this->add_action_if_not_exists( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		/**
		 * End of Astra theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Flatsome theme hook reverting
		 ******************************************************/
		 $this->add_action_if_not_exists( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		 $this->remove_action_if_exists( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display'  );
		/**
		 * End of Flatsome theme hook reverting
		 ******************************************************/

		/*******************************************************
		* Electro theme hook reverting
		******************************************************/
		$this->remove_action_if_exists('electro_product_item_hover_area', 'electro_loop_action_buttons', 10);

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_outer', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10);

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20);

		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46);

		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60);

		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96);

		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130);

		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close', 145);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close', 150);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);

		$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link', 90);
		$this->remove_action_if_exists('woocommerce_get_price_html', 'electro_wrap_price_html', 90);
		/**
		* Electro of Neve theme hook reverting
		******************************************************/

	}

	public function theme_conflicts_in_elementor_editor_up_sells() {

		/*******************************************************
		 * OceanWP theme cart page hook for cross-sell reverting..
		 ******************************************************/

		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		$this->add_action_if_not_exists('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');

		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');

		$this->remove_action_if_found_14('woocommerce_cart_collaterals', '\OceanWP_WooCommerce_Config', 'cross_sell_display');
		$this->remove_action_if_found_14('woocommerce_after_single_product_summary', '\OceanWP_WooCommerce_Config', 'upsell_display');
		$this->remove_action_if_found_14('ocean_after_product_entry_image', '\OceanWP_WooCommerce_Config', 'quick_view_button');
		$this->remove_action_if_found_14('ocean_after_product_entry_slider', '\OceanWP_WooCommerce_Config', 'quick_view_button');

		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_before_template_part', '\OceanWP_WooCommerce_Config', 'before_template_part');
		$this->add_action_if_not_exists('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		/**
		 * End of OceanWP theme hook reverting
		 ******************************************************/


		/*******************************************************
		 * Porto theme cart page hook for cross-sell reverting...
		 *
		 ******************************************************/

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10) ;
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title');
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woocommerce_pagination', 50);
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

		/**
		 * End of Porto theme hook reverting
		 ******************************************************/

		/*******************************************************
		 * Woodmart theme cart page hook for cross-sell reverting...
		 *******************************************************/

		$this->remove_action_if_exists( 'woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail', 10 );

		/**
		 * End of Woodmart theme hook reverting
		 ******************************************************/

		/*******************************************************
		* Electro theme hook reverting
		******************************************************/
		$this->remove_action_if_exists('electro_product_item_hover_area', 'electro_loop_action_buttons', 10);

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_outer', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10);

		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20);

		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46);

		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60);

		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96);

		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130);

		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close', 145);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close', 150);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);

		$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link', 90);
		$this->remove_action_if_exists('woocommerce_get_price_html', 'electro_wrap_price_html', 90);
		/**
		* Electro of Neve theme hook reverting
		******************************************************/
	}

	public function theme_conflicts_in_elementor_editor_related_products() {

			/*******************************************************
			 * OceanWP theme cart page hook for cross-sell reverting..
			 ******************************************************/

			$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
			$this->add_action_if_not_exists('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

			$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');

			$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');

			$this->remove_action_if_found_14('woocommerce_cart_collaterals', '\OceanWP_WooCommerce_Config', 'cross_sell_display');
			$this->remove_action_if_found_14('woocommerce_after_single_product_summary', '\OceanWP_WooCommerce_Config', 'upsell_display');
			$this->remove_action_if_found_14('ocean_after_product_entry_image', '\OceanWP_WooCommerce_Config', 'quick_view_button');
			$this->remove_action_if_found_14('ocean_after_product_entry_slider', '\OceanWP_WooCommerce_Config', 'quick_view_button');

			$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');
			$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');
			$this->remove_action_if_found_14('woocommerce_before_template_part', '\OceanWP_WooCommerce_Config', 'before_template_part');
			$this->add_action_if_not_exists('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
			$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
			$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
			$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
			$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
			$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
			$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
			$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
			$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

			/**
			 * End of OceanWP theme hook reverting
			 ******************************************************/



			/*******************************************************
			 * Porto theme cart page hook for cross-sell reverting...
			 *
			 ******************************************************/

			$this->remove_action_if_exists( 'woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10 );
			$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1 );
			$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100 );
			$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title' );
			$this->remove_action_if_exists( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 50 );
			$this->add_action_if_not_exists( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

			/**
			 * End of Porto theme hook reverting
			 ******************************************************/

			/*******************************************************
			 * Woodmart theme cart page hook for cross-sell reverting...
			 *******************************************************/

			$this->remove_action_if_exists( 'woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail', 10 );

			/**
			 * End of Woodmart theme hook reverting
			 ******************************************************/

			/*******************************************************
			 * Astra theme hook reverting
			 ******************************************************/
			$this->remove_action_if_found_14( 'woocommerce_product_get_rating_html', '\Astra_Woocommerce', 'rating_markup' );
			$this->add_action_if_not_exists( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			/**
			 * End of Astra theme hook reverting
			 ******************************************************/

			/*******************************************************
			 * Neve theme hook reverting
			 ******************************************************/
			$this->remove_action_if_found_14( 'woocommerce_before_shop_loop_item','\Neve\Views\Product_Layout', 'card_content_wrapper' );
			$this->remove_action_if_found_14( 'woocommerce_before_shop_loop_item_title','\Neve\Views\Product_Layout', 'product_image_wrap' );
			$this->remove_action_if_found_14( 'woocommerce_before_shop_loop_item','\Neve\Views\Product_Layout', 'card_content_wrapper', 1);
			$this->remove_action_if_found_14( 'woocommerce_after_shop_loop_item','\Neve\Views\Product_Layout', 'wrapper_close_div', 100);
			$this->remove_action_if_found_14( 'woocommerce_before_shop_loop_item_title','\Neve\Views\Product_Layout', 'out_of_stock_badge' );
			$this->remove_action_if_found_14( 'woocommerce_before_shop_loop_item_title','\Neve\Views\Product_Layout', 'wrapper_close_div' );
			/**
			 * End of Neve theme hook reverting
			 ******************************************************/

			/*******************************************************
			* Electro theme hook reverting
			******************************************************/
			$this->remove_action_if_exists('electro_product_item_hover_area', 'electro_loop_action_buttons', 10);

			$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_outer', 0);
			$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10);

			$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15);
			$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20);

			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46);

			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55);
			$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60);

			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96);

			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130);

			$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close', 145);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close', 150);
			$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);

			$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link', 90);
			$this->remove_action_if_exists('woocommerce_get_price_html', 'electro_wrap_price_html', 90);
			/**
			 * Electro of Neve theme hook reverting
			 ******************************************************/

	}


	public function theme_conflicts_my_account_page() {

		$this->remove_action_if_exists('woocommerce_account_dashboard', 'woodmart_my_account_links');
		$this->remove_action_if_exists('woocommerce_account_dashboard', 'flatsome_my_account_dashboard');
	}


	public function theme_conflicts__archive_products_widget_during_render() {

		$this->remove_action_if_exists('woocommerce_shop_loop', 'electro_shop_loop');

		$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_open', 1 );
		$this->remove_action_if_exists( 'woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title_close', 100 );
	}


	public function theme_conflicts_in_specific_footer_area() {

		$this->remove_action_if_found_14('wp_footer', '\OceanWP_WooCommerce_Config', 'get_mini_cart_sidebar');
	}


	public function theme_conflicts_archive_page_after_wp_loaded() {

		/**
		 * Neve theme
		 */
		$this->remove_action_if_exists('neve_bc_count', 'woocommerce_result_count');
		$this->remove_action_if_exists('nv_woo_header_bits', 'woocommerce_catalog_ordering', 30);
		$this->remove_action_if_exists('neve_bc_count', 'woocommerce_breadcrumb');

		/**
		 * Hestia theme
		 */
		$this->remove_action_if_exists('woocommerce_before_main_content', 'hestia_woocommerce_before_main_content', 10);
		$this->remove_action_if_exists('woocommerce_after_main_content', 'hestia_woocommerce_after_main_content', 9);


		/**
		 * flatsome header hooks reverting to remove the woocommerce default sorting
		 */
		$this->remove_action_if_exists('flatsome_breadcrumb', 'woocommerce_breadcrumb', 20);
		$this->remove_action_if_exists('flatsome_after_header', 'flatsome_category_header');

		/**
		 * Electro theme
		 */
		//$this->remove_action_if_exists('woocommerce_shop_loop', 'electro_shop_loop', 10);
	}


	public function theme_conflicts_in_editor__archive_products_widget() {

    /**
		 * Storefront theme
		 */
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'storefront_sorting_wrapper', 9);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'storefront_sorting_wrapper_close', 31);

		/**
		 * Porto Theme
		 */
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'porto_woocommerce_open_before_clearfix_div', 11);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'porto_woocommerce_close_before_clearfix_div', 80);
		$this->remove_action_if_exists('woocommerce_after_shop_loop', 'porto_woocommerce_open_after_clearfix_div', 1);
		$this->remove_action_if_exists('woocommerce_after_shop_loop', 'porto_woocommerce_close_after_clearfix_div', 999);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'porto_grid_list_toggle', 70);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woocommerce_pagination', 50);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'porto_loop_product_thumbnail', 10);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'porto_woocommerce_shop_loop_item_title');
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
		$this->add_action_if_not_exists('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');

		/**
		 * xstore theme
		 */
		$this->remove_action_if_exists('woocommerce_sale_flash', 'etheme_woocommerce_sale_flash', 20);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'etheme_grid_list_switcher', 35);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'etheme_products_per_page_select', 37);


		/**
		 * oceanwp theme
		 */
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'add_shop_loop_div');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'close_shop_loop_div');
		$this->remove_action_if_found_14('woocommerce_before_template_part', '\OceanWP_WooCommerce_Config', 'before_template_part');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'grid_list_buttons');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop', '\OceanWP_WooCommerce_Config', 'result_count');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item', '\OceanWP_WooCommerce_Config', 'add_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'close_shop_loop_item_inner_div');
		$this->remove_action_if_found_14('woocommerce_before_shop_loop_item_title', '\OceanWP_WooCommerce_Config', 'loop_product_thumbnail');
		$this->remove_action_if_found_14('woocommerce_after_shop_loop_item', '\OceanWP_WooCommerce_Config', 'archive_product_content');

		$this->add_action_if_not_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		$this->add_action_if_not_exists('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		/**
		 * woodmart theme
		 */
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woodmart_show_sidebar_btn', 25);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'woodmart_products_per_page_select', 25);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'woodmart_template_loop_product_thumbnail', 10);

		/**
		 * Electro theme
		 */
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'electro_shop_control_bar', 11);
		$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'electro_wrap_add_to_cart_link', 90);
		$this->remove_action_if_exists('woocommerce_loop_add_to_cart_link', 'redux_apply_catalog_mode_for_product_loop', 85);

		$this->remove_action_if_exists('electro_product_item_hover_area', 'electro_loop_action_buttons', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_outer', 0);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15);
		$this->remove_action_if_exists('woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55);
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close', 145);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close', 150);
		$this->remove_action_if_exists('woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close', 160);
		$this->remove_action_if_exists('woocommerce_before_shop_loop', 'electro_wc_loop_title', 10);

		/**
		 * Flatsome theme
		 */
		$this->remove_action_if_exists('woocommerce_shop_loop_item_title', 'flatsome_woocommerce_shop_loop_category', 0);
	}


	/**
	 * This is a code of 14th class for some very tricky position we are
	 * It is totally possible to get wrong instance priority with this function, hence the wrong action removed but practically highly unlikely :fingercross
	 *
	 *
	 * @param $tag
	 * @param $class_name - must a full qualified class name
	 * @param $instance_method
	 * @param int $spl_hash_length - this is 32 right now [https://github.com/php/php-src/blob/82ccd47d397314d82feeb90b055625f0fcc9bde4/ext/spl/php_spl.c], or $ln = strlen(spl_object_hash( new stdClass()))
	 * @return bool|int|string
	 */
	private function has_filter_14($tag, $class_name, $instance_method, $spl_hash_length = 32) {

		if(has_action($tag)) {

			global $wp_filter;

			$callbacks = $wp_filter[$tag]->callbacks;

			if(!empty($callbacks)) {

				foreach($callbacks as $priority => $arr) {

					foreach($arr as $ky => $conf) {

						if(strpos($ky, $instance_method) !== false) {

							if($ky == $class_name . '::' . $instance_method) {
								return true;
							}

							if(isset($conf['function'][0]) && $conf['function'][0] instanceof $class_name) {

								$rem = str_replace($instance_method, '', $ky);

								return strlen($rem) == $spl_hash_length ? $priority : false;
							}
						}
					}
				}
			}
		}

		return false;
	}

	/**
	 * @param $tag
	 * @param $class_name
	 * @param $instance_method
	 * @param $priority
	 * @param int $spl_hash_length
	 * @return bool
	 */
	private function remove_action_14($tag, $class_name, $instance_method, $priority, $spl_hash_length = 32) {

		if($priority === false) {
			return false;
		}

		global $wp_filter;

		if(!empty($wp_filter[$tag]->callbacks[$priority])) {

			foreach($wp_filter[$tag]->callbacks[$priority] as $ky => $conf) {

				if(strpos($ky, $instance_method) !== false) {

					if($ky == $class_name . '::' . $instance_method) {

						unset($wp_filter[$tag]->callbacks[$priority][$ky]);

						return true;
					}

					$rem = str_replace($instance_method, '', $ky);

					if(strlen($rem) == $spl_hash_length) {

						unset($wp_filter[$tag]->callbacks[$priority][$ky]);

						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Are you wandering about the number 14? :D, why??
	 * Still nosy?  - because this is a hacky  solution for an awkward situation we are in!
	 *
	 * @param $tag
	 * @param $class_name - full qualified class name
	 * @param $instance_method
	 * @return bool
	 */
	private function remove_action_if_found_14($tag, $class_name, $instance_method, $priority = 10) {
		//$priority = $this->has_filter_14($tag, $class_name, $instance_method);
		return $this->remove_action_14($tag, $class_name, $instance_method, $priority);
	}


	private function remove_action_if_exists($tag, $func, $priority = null) {

		if($priority === null) {

			if(has_action($tag, $func) !== false) {

				remove_action($tag, $func);
			}

			return;
		}


		if(has_action($tag, $func) !== false) {

			remove_action($tag, $func, intval($priority));
		}

		return;
	}


	private function add_action_if_not_exists($tag, $func, $priority = null) {

		if($priority === null) {

			if(has_action($tag, $func) === false) {

				add_action($tag, $func);
			}

			return;
		}

		if(has_action($tag, $func) === false) {

			add_action($tag, $func, intval($priority));
		}

		return;
	}
}
