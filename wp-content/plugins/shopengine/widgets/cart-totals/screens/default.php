<?php

defined('ABSPATH') || exit;

if(is_checkout()) {
	return;
}

if(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) {

	wc()->frontend_includes();

	if(empty(WC()->cart->cart_contents)) {

		WC()->session = new WC_Session_Handler();
		WC()->session->init();
		WC()->customer = new WC_Customer(get_current_user_id(), true);
		WC()->cart = new WC_Cart();

		$demo_products = get_posts(
			array(
				'post_type'   => 'product',
				'numberposts' => 1,
				'post_status' => 'publish',
				'fields'      => 'ids',
				'orderby'     => 'ID',
				'order'       => 'DESC'
			)
		);
		if(!empty($demo_products)) {
			foreach($demo_products as $id) {
				WC()->cart->add_to_cart($id);
			}
		}
	}
	WC()->cart->calculate_totals();
}

?>


<div class="shopengine-cart-totals">

    <div class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

		<?php 
			// do_action('woocommerce_before_cart_totals'); cause issue with flatsome theme / add extra markup at the top of the main table
		?>

        <table cellspacing="0" class="shop_table shop_table_responsive">

            <tr class="cart-subtotal">
                <th><?php esc_html_e('Subtotal', 'shopengine'); ?></th>
                <td data-title="<?php esc_attr_e('Subtotal', 'shopengine'); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
            </tr>

			<?php foreach(WC()->cart->get_coupons() as $code => $coupon) : ?>
                <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                    <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
                    <td data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></td>
                </tr>
			<?php endforeach; ?>

			<?php

			if(WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

				<?php do_action('woocommerce_cart_totals_before_shipping'); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action('woocommerce_cart_totals_after_shipping'); ?>

			<?php elseif(WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

                <tr class="shipping">
                    <th><?php esc_html_e('Shipping', 'shopengine'); ?></th>
                    <td data-title="<?php esc_attr_e('Shipping', 'shopengine'); ?>"><?php woocommerce_shipping_calculator(); ?></td>
                </tr>

			<?php endif; ?>

			<?php foreach(WC()->cart->get_fees() as $fee) : ?>
                <tr class="fee">
                    <th><?php echo esc_html($fee->name); ?></th>
                    <td data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></td>
                </tr>
			<?php endforeach; ?>

			<?php
			if(wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
				$taxable_address = WC()->customer->get_taxable_address();
				$estimated_text = '';

				if(WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
					/* translators: %s location. */
					$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'shopengine') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
				}

				if('itemized' === get_option('woocommerce_tax_total_display')) {
					foreach(WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						?>
                        <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                            <th><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                            <td data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                        </tr>
						<?php
					}
				} else {
					?>
                    <tr class="tax-total">
                        <th><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                        <td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                    </tr>
					<?php
				}
			}
			?>

			<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

            <tr class="order-total">
                <th><?php esc_html_e('Total', 'shopengine'); ?></th>
                <td data-title="<?php esc_attr_e('Total', 'shopengine'); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
            </tr>

			<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

        </table>

        <div class="wc-proceed-to-checkout">
			<?php do_action('woocommerce_proceed_to_checkout'); ?>
        </div>

		<?php do_action('woocommerce_after_cart_totals'); ?>

    </div>

</div>
