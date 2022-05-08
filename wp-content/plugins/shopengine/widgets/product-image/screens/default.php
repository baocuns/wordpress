<?php

defined('ABSPATH') || exit;

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();


/*
	-----------------------------------------------
	Changed flash sale text to percentage off text
	-----------------------------------------------
*/
if( $product->is_on_sale() && 'yes' === $settings['shopengine_sale_flash_status'] ) {

	$regular_price = $product->get_regular_price();
	$current_price = $product->get_price();

	if( !empty($regular_price) && !empty($current_price) ){

		$flash_slae_position = 'position-' . $settings['shopengine_flash_sale_position'];
		$s_p = ( $regular_price - $current_price ) / $regular_price * 100;
		$sale_price = \Automattic\WooCommerce\Utilities\NumberUtil::round( $s_p );

		echo '<span class="onsale ' . $flash_slae_position . '">' . esc_html($sale_price) . esc_html__( '% OFF', 'shopengine' ) . '</span>';
	}

} // flash sale end


wc_get_template('single-product/product-image.php');
