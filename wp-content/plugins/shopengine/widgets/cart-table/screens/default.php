<?php

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
}

WC()->cart->calculate_totals();

$file = WC()->cart->is_empty() ? '/empty.php' : '/cart.php';

wc_get_template($file, ['settings' => $settings], __DIR__, __DIR__);
