<?php defined('ABSPATH') || exit;

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_part_filter_by_match('woocommerce/content-product.php', 'templates/content-product.php');

$editor_mode = (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview());

if($editor_mode) {

	$args = array(
		'type' =>  ['simple'],
		'limit' => $shopengine_cross_sells_product_to_show,
	);

	$parent_product_array = wc_get_products($args);

	foreach($parent_product_array as $prod) {

		$crosssell_products[] = $prod->get_id();
	}

	add_filter('woocommerce_cart_crosssell_ids', function ($cross_sell_ids) use ($crosssell_products) {

	    $cross_sell_ids  = $crosssell_products;

	    return $cross_sell_ids;
	});
}

$cross_sells = null;

if ( WC()->cart ) {
	$cross_sells = array_filter( array_map( 'wc_get_product', WC()->cart->get_cross_sells() ), 'wc_products_array_filter_visible' );
}

if(empty($cross_sells)) {
	return;
}

if($editor_mode) {

	global $wp_query, $post;;
	$main_query = clone $wp_query;
	$main_post = clone $post;

	$wp_query = new \WP_Query([]);
}

$is_slider_enable = ($shopengine_cross_sells_product_enable_slider == "yes") ? true : false;
$init_slider = ($shopengine_cross_sells_product_to_show > $shopengine_cross_sells_product_slider_perview) && (count($cross_sells) > $shopengine_cross_sells_product_slider_perview) ;

// slider controls for the template file
$slider_options = [
	'slider_enabled'        => $is_slider_enable,
	'slides_to_show'		=> $shopengine_cross_sells_product_slider_perview,
	'slider_loop'           => ($init_slider && $shopengine_cross_sells_product_slider_loop === "yes") ? true : false,
	'slider_autoplay'       => ($shopengine_cross_sells_product_slider_autoplay === "yes") ? true : false,
	'slider_autoplay_delay' => $shopengine_cross_sells_product_slider_autoplay_delay,
	'slider_space_between'  => $shopengine_cross_sells_product_column_gap['size'],
];

$columns	= $is_slider_enable ? $shopengine_cross_sells_product_slider_perview : $shopengine_cross_sells_product_columns;

?>

<div class="shopengine-cross-sells <?php echo ($is_slider_enable ? 'slider-enabled' : 'slider-disabled'); ?>" data-controls="<?php echo esc_attr(json_encode($slider_options)); ?>">
	<?php
	woocommerce_cross_sell_display($shopengine_cross_sells_product_to_show, $columns, $shopengine_cross_sells_product_orderby, $shopengine_cross_sells_product_order);

	if($init_slider && $is_slider_enable && $shopengine_cross_sells_product_slider_show_dots) {
		echo '<div class="swiper-pagination" style="width: 100%;"></div>';
	}

	if($init_slider && $is_slider_enable && $shopengine_cross_sells_product_slider_show_arrows) {
		echo sprintf(
			'<div class="swiper-button-prev">%1$s</div><div class="swiper-button-next">%2$s</div>',
			$this->get_icon_html($shopengine_cross_sells_product_slider_left_arrow_icon),
			$this->get_icon_html($shopengine_cross_sells_product_slider_right_arrow_icon)
		);
	}
	?>
</div>

<?php

if($editor_mode) {
	$wp_query = $main_query;
	$post = $main_post;
	wp_reset_query();
	wp_reset_postdata();
}
