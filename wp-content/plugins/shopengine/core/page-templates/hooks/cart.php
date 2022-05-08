<?php

namespace ShopEngine\Core\Page_Templates\Hooks;

defined('ABSPATH') || exit;

use ShopEngine\Core\Builders\Templates;
use ShopEngine\Utils\Shipping_Calculation;
 
class Cart extends Base {

	protected $page_type = 'cart';
	protected $template_part = 'content-cart.php';

	public function init() : void {

		add_action('woocommerce_shipping_init', function () {
			\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();
		});

		add_action('template_redirect', function () {
			Shipping_Calculation::output();
		});

		// add_action('wp_loaded', [$this, 'delayed_hook_conflicts'], 9999);
		$this->delayed_hook_conflicts();
	}

	public function delayed_hook_conflicts() {

		$themeName = get_template();

		if ( $themeName == 'porto' ) {
			remove_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 20 );
		}

		// revert this hook for cart page and editor mode
		if ( $themeName == 'flatsome' || $themeName == 'hestia' ) {
			add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			remove_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
		}

	}

	protected function template_include_pre_condition(): bool {

		return is_cart();
	}

}
