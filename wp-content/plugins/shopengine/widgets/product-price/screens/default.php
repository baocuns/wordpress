<?php defined('ABSPATH') || exit;

$product = \ShopEngine\Widgets\Products::instance()->get_product(get_post_type());

?>

<div class="shopengine-product-price">

	<?php wc_get_template('/single-product/price.php'); ?>

</div>
