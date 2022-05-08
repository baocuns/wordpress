<div class="shopengine-checkout-shipping-methods">
    <table class="shopengine_woocommerce_shipping_methods">
		<?php

		\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();

		wc()->frontend_includes();

		if(empty(WC()->cart->cart_contents)) {

			WC()->session = new \WC_Session_Handler();
			WC()->session->init();
			WC()->customer = new \WC_Customer(get_current_user_id(), true);
			WC()->cart = new \WC_Cart();

		}

		WC()->cart->calculate_totals();

		if(WC()->cart && WC()->cart->needs_shipping() && WC()->cart->show_shipping()) :
			?>
			<?php do_action('woocommerce_review_order_before_shipping'); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action('woocommerce_review_order_after_shipping'); ?>

		<?php
		endif;

		?>
    </table>
</div>
