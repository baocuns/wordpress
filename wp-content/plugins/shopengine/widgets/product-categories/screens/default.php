<?php defined('ABSPATH') || exit;

$post_type = get_post_type();

$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);

if(!has_term('', 'product_cat', $product->get_id())) {

	if($post_type == \ShopEngine\Core\Template_Cpt::TYPE) {
		echo esc_html__('This product has no categories', 'shopengine');
	}

	return;
}
?>


<div class="shopengine-cats shopengine-flex-align">

	<?php if(isset($settings['shopengine_product_cats_label_show']) && $settings['shopengine_product_cats_label_show'] == 'yes') : ?>

        <span class="product-cats-label"><?php echo sprintf(_n('Category:', 'Categories:', count($product->get_category_ids()), 'shopengine')); ?></span>

	<?php endif;

	echo wc_get_product_category_list($product->get_id(), ', ', '<span class="product-cats-links">', '</span>'); ?>

</div>
