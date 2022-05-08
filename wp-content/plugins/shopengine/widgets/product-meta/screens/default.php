<?php

$post_type = get_post_type();

if($post_type === \ShopEngine\Core\Template_Cpt::TYPE) {

	global $product;

	$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);
}

?>

<div class="shopengine-product-meta">
	<?php woocommerce_template_single_meta(); ?>
</div>
