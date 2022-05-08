<?php

namespace ShopEngine\Utils;

defined('ABSPATH') || exit;

use WC_Validation;
use Exception;

/**
 * Global helper class.
 *
 * @since 1.0.0
 */
class Shipping_Calculation {

	/**
	 * Calculate shipping for the cart.
	 *
	 * @throws Exception When some data is invalid.
	 */
	public static function calculate_shipping() {

		try {
			WC()->shipping()->reset_shipping();

			$address = array();

			$address['country']  = isset( $_POST['calc_shipping_country'] ) ? wc_clean( wp_unslash( $_POST['calc_shipping_country'] ) ) : ''; // WPCS: input var ok, CSRF ok, sanitization ok.
			$address['state']    = isset( $_POST['calc_shipping_state'] ) ? wc_clean( wp_unslash( $_POST['calc_shipping_state'] ) ) : ''; // WPCS: input var ok, CSRF ok, sanitization ok.
			$address['postcode'] = isset( $_POST['calc_shipping_postcode'] ) ? wc_clean( wp_unslash( $_POST['calc_shipping_postcode'] ) ) : ''; // WPCS: input var ok, CSRF ok, sanitization ok.
			$address['city']     = isset( $_POST['calc_shipping_city'] ) ? wc_clean( wp_unslash( $_POST['calc_shipping_city'] ) ) : ''; // WPCS: input var ok, CSRF ok, sanitization ok.

			$address = apply_filters( 'woocommerce_cart_calculate_shipping_address', $address );

			if ( $address['postcode'] && ! WC_Validation::is_postcode( $address['postcode'], $address['country'] ) ) {
				throw new Exception( __( 'Please enter a valid postcode / ZIP.', 'shopengine' ) );
			} elseif ( $address['postcode'] ) {
				$address['postcode'] = wc_format_postcode( $address['postcode'], $address['country'] );
			}

			if ( $address['country'] ) {
				if ( ! WC()->customer->get_billing_first_name() ) {
					WC()->customer->set_billing_location( $address['country'], $address['state'], $address['postcode'], $address['city'] );
				}
				WC()->customer->set_shipping_location( $address['country'], $address['state'], $address['postcode'], $address['city'] );
			} else {
				WC()->customer->set_billing_address_to_base();
				WC()->customer->set_shipping_address_to_base();
			}

			WC()->customer->set_calculated_shipping( true );
			WC()->customer->save();

			wc_add_notice( __( 'Shipping costs updated.', 'shopengine' ), 'notice' );

			do_action( 'woocommerce_calculated_shipping' );

		} catch ( Exception $e ) {
			if ( ! empty( $e ) ) {
				wc_add_notice( $e->getMessage(), 'error' );
			}
		}
	}

	/**
	 * Output the cart shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public static function output() {

		$nonce_value = wc_get_var( $_REQUEST['woocommerce-shipping-calculator-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

		// Update Shipping. Nonce check uses new value and old value (woocommerce-cart). @todo remove in 4.0.
		if ( ! empty( $_POST['calc_shipping'] ) && ( wp_verify_nonce( $nonce_value, 'woocommerce-shipping-calculator' ) || wp_verify_nonce( $nonce_value, 'woocommerce-cart' ) ) ) { // WPCS: input var ok.
			self::calculate_shipping();

			// Also calc totals before we check items so subtotals etc are up to date.
			WC()->cart->calculate_totals();
		}
	}
}