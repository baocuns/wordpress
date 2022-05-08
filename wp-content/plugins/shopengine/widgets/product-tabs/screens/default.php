<?php

add_filter('woocommerce_product_tabs', function ($tabs) {

	if(isset($tabs['description'])) {
		$tabs['description']['callback'] = 'woocommerce_product_description_tab';
	}

	return $tabs;
}, 999);


\ShopEngine\Widgets\Widget_Helper::instance()->comment_template_filter_checker();


\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter_by_match('woocommerce/single-product/tabs/tabs.php', 'templates/single-product/tabs/tabs.php');

$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);

$product_tabs = apply_filters('woocommerce_product_tabs', []);

$in_editor_mode = \ShopEngine\Core\Template_Cpt::TYPE == get_post_type();

if($in_editor_mode) {

	global $product, $post;

	$main_post = clone $post;

	$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);
	$post = get_post($product->get_id());

	add_filter('the_content', [\ShopEngine\Widgets\Products::instance(), 'product_tab_content_preview']);

	$product_tabs = woocommerce_default_product_tabs();
}

?>

    <div class="shopengine-product-tabs">
		<?php woocommerce_output_product_data_tabs(); ?>
    </div>

<?php

if($in_editor_mode) {

	$post = $main_post;
}
