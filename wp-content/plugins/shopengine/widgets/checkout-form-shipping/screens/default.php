<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 *
 * wp-content/plugins/woocommerce/templates/checkout/form-shipping.php
 */

defined( 'ABSPATH' ) || exit;

$post_type = get_post_type();

$checkout = WC()->checkout();

if(empty(WC()->cart->cart_contents)) {

	wc()->frontend_includes();

	WC()->session = new WC_Session_Handler();
	WC()->session->init();
	WC()->customer = new WC_Customer(get_current_user_id(), true);
	WC()->cart = new WC_Cart();

	$demo_products = \ShopEngine\Widgets\Products::instance()->get_a_simple_product_id();

	WC()->cart->add_to_cart($demo_products);
}

$show_condition = WC()->cart->needs_shipping_address();

if(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) {

	$show_condition = true;
}

if(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE || is_checkout()) { ?>

    <div class="shopengine-checkout-form-shipping">

        <div class="woocommerce-shipping-fields">
			<?php if(true === $show_condition) : ?>

                <h3 id="ship-to-different-address">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                        <input id="ship-to-different-address-checkbox"
                               class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1); ?>
                               type="checkbox" name="ship_to_different_address" value="1"/>
                        <span><?php esc_html_e('Ship to a different address?', 'shopengine'); ?></span>
                    </label>
                </h3>

                <div class="shipping_address">

					<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

                    <div class="woocommerce-shipping-fields__field-wrapper">
						<?php
						$fields = $checkout->get_checkout_fields('shipping');

						foreach($fields as $key => $field) {
							woocommerce_form_field($key, $field, $checkout->get_value($key));
						}
						?>
                    </div>

					<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

                </div>

			<?php endif; ?>
        </div>

    </div>
	<?php
}
