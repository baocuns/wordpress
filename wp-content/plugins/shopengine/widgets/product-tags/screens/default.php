<?php defined('ABSPATH') || exit;

$post_type = get_post_type();

$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);

if(!has_term('', 'product_tag', $product->get_id())) {

	if($post_type == \ShopEngine\Core\Template_Cpt::TYPE) {
		echo esc_html__('This product has no tags', 'shopengine');
	}

	return;
}

?>

<div class="shopengine-tags">

	<?php if(isset($settings['shopengine_product_tags_label_show']) && $settings['shopengine_product_tags_label_show'] == 'yes'): ?>

        <span class="product-tags-label"><?php echo sprintf(_n('TAG:', 'TAGs:', count($product->get_tag_ids()), 'shopengine')); ?></span>

	<?php endif;

	echo wc_get_product_tag_list($product->get_id(), ', ', '<span class="product-tags-links">', '</span>');

	do_action('woocommerce_product_meta_end'); ?>

</div>