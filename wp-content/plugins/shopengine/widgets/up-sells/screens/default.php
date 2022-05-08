<?php defined('ABSPATH') || exit;

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_part_filter_by_match('woocommerce/content-product.php', 'templates/content-product.php');

$upsell_ids = $product->get_upsell_ids();

$upsells = array_filter(array_map('wc_get_product', $upsell_ids), 'wc_products_array_filter_visible');

$editor_mode = (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview());

if($editor_mode) {

	global $wp_query, $post;;
	$main_query = clone $wp_query;
	$main_post = clone $post;

	$wp_query = new \WP_Query([]);

	$args = [
		'type'  => ['simple'],
		'limit' => $shopengine_up_sells_product_to_show,
	];

	$upsells = wc_get_products($args);

	unset($args, $upsell_ids);
}

if(empty($upsells)) {

	return;
}

$is_slider_enable = ($shopengine_up_sells_product_enable_slider == "yes") ? true : false;
$init_slider = ($shopengine_up_sells_product_to_show > $shopengine_up_sells_product_slider_perview) && (count($upsells) > $shopengine_up_sells_product_slider_perview) ;

// slider controls for the template file
$slider_options = [
	'slider_enabled'        => $is_slider_enable,
	'slides_to_show'		=> $shopengine_up_sells_product_slider_perview,
	'slider_loop'           => ($init_slider && $shopengine_up_sells_product_slider_loop === "yes") ? true : false,
	'slider_autoplay'       => ($shopengine_up_sells_product_slider_autoplay === "yes") ? true : false,
	'slider_autoplay_delay' => $shopengine_up_sells_product_slider_autoplay_delay,
	'slider_space_between'  => $shopengine_up_sells_product_column_gap['size'],
];

$columns	= $is_slider_enable ? $shopengine_up_sells_product_slider_perview : $shopengine_up_sells_product_columns;

?>

<div class="shopengine-up-sells <?php echo ($is_slider_enable ? 'slider-enabled' : 'slider-disabled'); ?>" data-controls="<?php echo esc_attr(json_encode($slider_options)); ?>">
	<?php
	if($post_type == \ShopEngine\Core\Template_Cpt::TYPE) {
		wc_get_template(
			'single-product/up-sells.php',
			[
				'upsells'        => $upsells,
				'posts_per_page' => $shopengine_up_sells_product_to_show,
				'orderby'        => $shopengine_up_sells_product_orderby,
				'columns'        => $columns,
			]
		);
	} else {
		woocommerce_upsell_display($shopengine_up_sells_product_to_show, $columns, $shopengine_up_sells_product_orderby, $shopengine_up_sells_product_order);
	}

	if($init_slider && $is_slider_enable && $shopengine_up_sells_product_slider_show_dots) {
		echo '<div class="swiper-pagination" style="width: 100%;"></div>';
	}

	if($init_slider && $is_slider_enable && $shopengine_up_sells_product_slider_show_arrows) {
		echo sprintf(
			'<div class="swiper-button-prev">%1$s</div><div class="swiper-button-next">%2$s</div>',
			$this->get_icon_html($shopengine_up_sells_product_slider_left_arrow_icon),
			$this->get_icon_html($shopengine_up_sells_product_slider_right_arrow_icon)
		);
	}
	?>
</div>

<?php

if($editor_mode) {

	global $wp_query, $post;;

	$wp_query = $main_query;
	$post = $main_post;
	wp_reset_query();
	wp_reset_postdata();

	unset($main_query, $main_post);
}
