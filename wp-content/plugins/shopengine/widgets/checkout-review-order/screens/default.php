<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 *
 * wp-content/plugins/woocommerce/templates/checkout/form-checkout.php
 */

defined('ABSPATH') || exit;

if(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) {
	wc()->frontend_includes();

	if(empty(WC()->cart->cart_contents)) {

		WC()->session = new WC_Session_Handler();
		WC()->session->init();
		WC()->customer = new WC_Customer(get_current_user_id(), true);
		WC()->cart     = new WC_Cart();

		$demo_products = get_posts(
			[
				'post_type'   => 'product',
				'numberposts' => 1,
				'post_status' => 'publish',
				'fields'      => 'ids',
				'orderby'     => 'ID',
				'order'       => 'DESC',
			]
		);
		if(!empty($demo_products)) {
			foreach($demo_products as $id) {
				WC()->cart->add_to_cart($id);
			}
		}
	}

}
?>

    <div class="shopengine-checkout-review-order">

        <h3 id="order_review_heading"><?php esc_html_e('Your order', 'shopengine'); ?></h3>

        <div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action('woocommerce_checkout_before_order_review'); ?>
			<?php

            global $wp;

			if(isset($wp->query_vars['order-pay'])) {

				WC_Shortcode_Checkout::output([]);

			} else {
				woocommerce_order_review();
			}


			?>
        </div>
		<?php do_action('woocommerce_checkout_after_order_review'); ?>
    </div>
<?php
