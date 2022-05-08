<?php

defined('ABSPATH') || exit;

?>
<div class="shopengine-product-excerpt">

	<div class="woocommerce-product-details__short-description">
		<?php
		$product = \ShopEngine\Widgets\Products::instance()->get_product(get_post_type());
		$post = get_post($product->get_id());
		$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

		if(!$short_description && get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) {
			echo esc_html__('Dummy short description only for elementor preview mode if and only if the editor selected product has no short description.', 'shopengine');
		} else {
			echo \Shopengine\Utils\Helper::kses($short_description); // WPCS: XSS ok.
		}

		?>
	</div>

</div>