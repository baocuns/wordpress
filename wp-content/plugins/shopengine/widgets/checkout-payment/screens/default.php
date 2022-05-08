<?php

defined('ABSPATH') || exit;

global $wp;

if(isset($wp->query_vars['order-pay'])) {

	return;
}

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();

?>

<div class="shopengine-checkout-payment">
	<?php

	if(!empty(WC()->cart) && !WC()->cart->is_empty()) {

		woocommerce_checkout_payment();

	} elseif(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) {

		echo esc_html__('Your cart is empty, please add some simple product in cart and then come back to editor to see checkout page.', 'shopengine');
    }

	?>
</div>

