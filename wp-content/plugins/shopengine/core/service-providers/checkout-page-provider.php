<?php

namespace ShopEngine\Core\Service_Providers;


use ShopEngine;

class Checkout_Page_Provider {

	public function init() {
		add_action( 'shopengine-order-review-thumbnail', [ $this, 'add_product_thumbnail' ], 10, 4 );

		/**
		 * override woocommerce default template
		 */
		add_filter('wc_get_template', function ($template, $template_name = '', $args = '', $template_path = '', $default_path = '') {
			if ( strpos( $template, 'checkout/review-order.php' ) !== false ) {
				return ShopEngine::widget_dir() . 'checkout-review-order/screens/review-order-template.php';
			}
			return $template;
		  });
	}

	private function get_thumbnail( $cart_item ) {

		$product           = wc_get_product( $cart_item['product_id'] );
		$image_id          = $product->get_image_id();
		$default_image_url = wp_get_attachment_image( $image_id, 'full' );

		$product_id = isset( $cart_item['variation_id'] ) && $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'];

		return wp_get_attachment_image( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' ) ?? $default_image_url;

	}

	public function add_product_thumbnail( $cart_item ) {
		echo $this->get_thumbnail( $cart_item );
	}

}

