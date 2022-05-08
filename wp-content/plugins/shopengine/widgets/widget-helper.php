<?php

namespace ShopEngine\Widgets;

use ShopEngine\Traits\Singleton;

class Widget_Helper {

	use Singleton;

	public function wc_template_filter_by_match($match, $replace_with) {

		add_filter(
			'wc_get_template',
			function (
				$template,
				$template_name = '',
				$args = '',
				$template_path = '',
				$default_path = ''
			) use ($match, $replace_with) {

				if(strpos($template, $match) !== false) {

					$template = WC_ABSPATH . $replace_with;

					return $template;
				}

				return $template;
			}
		);
	}

	public function wc_template_part_filter_by_match($match, $replace_with) {

		add_filter('wc_get_template_part', function ($template, $slug = '', $name = '') use ($match, $replace_with) {

			if(strpos($template, $match) !== false) {

				$template = WC_ABSPATH . $replace_with;
			}

			return $template;
		});
	}

	public function wc_template_part_filter() {

		add_filter('wc_get_template_part', function ($template, $slug = '', $name = '') {

			if(strpos($template, 'woocommerce/content-product.php') !== false) {

				$template = WC_ABSPATH . 'templates/content-product.php';

			} elseif(strpos($template, 'woocommerce/content-product-base.php') !== false) {

				//$template = WC_ABSPATH . 'templates/content-product.php';

			}

			return $template;

		}, 999);
	}

	/**
	 *  replace single woocommerce template  .
	 * alternative function for wc_template_part_filter_by_match, wc_template_filter_by_match
	 *
	 * @param $needle
	 * @param string $filter_tag
	 */
	public function wc_template_replace( $needle, $filter_tag = 'wc_get_template' ) { 
		add_filter( $filter_tag, function ( $template ) use ( $needle ) {

			if ( strpos( $template, 'woocommerce/' . $needle ) !== false ) {
				$template = WC_ABSPATH . 'templates/' . $needle;
			}
			return $template;
		}, 999 );
	} 

	/**
	 *  replace multiple woocommerce templates  .
	 * alternative function for wc_template_part_filter_by_match, wc_template_filter_by_match, wc_template_part_filter,wc_template_filter
	 *
	 * @param $needles
	 * @param string $filter_tag
	 */
	public function wc_template_replace_multiple( $needles, $filter_tag = 'wc_get_template' ) {
		add_filter($filter_tag, function ($template) use($needles){

			foreach ($needles as $needle){
				if(strpos($template, 'woocommerce/'.$needle) !== false) {
					$template = WC_ABSPATH . 'templates/'.$needle;
					break;
				}
			} 
			return $template;
		}, 999);
	} 
  
	public function wc_template_filter() {

		add_filter('wc_get_template', function ($template, $template_name = '', $args = '', $template_path = '', $default_path = '') {

			if(strpos($template, 'woocommerce/global/breadcrumb.php') !== false) {

				$template = WC_ABSPATH . 'templates/global/breadcrumb.php';

			} elseif(strpos($template, 'single-product/up-sells.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/up-sells.php';

			} elseif(strpos($template, 'woocommerce/loop/loop-start.php') !== false) {

				$template = WC_ABSPATH . 'templates/loop/loop-start.php';

			} elseif(strpos($template, 'woocommerce/loop/loop-end.php') !== false) {

				$template = WC_ABSPATH . 'templates/loop/loop-end.php';

			} elseif(strpos($template, 'woocommerce/global/wrapper-end.php') !== false) {

				$template = WC_ABSPATH . 'templates/global/wrapper-end.php';

			} elseif(strpos($template, 'woocommerce/global/wrapper-start.php') !== false) {

				$template = WC_ABSPATH . 'templates/global/wrapper-start.php';

			} elseif(strpos($template, 'woocommerce/loop/sale-flash.php') !== false) {

				$template = WC_ABSPATH . 'templates/loop/sale-flash.php';

			} elseif(strpos($template, 'woocommerce/single-product/product-image.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/product-image.php';

			} elseif(strpos($template, 'woocommerce/single-product/product-thumbnails.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/product-thumbnails.php';

			} elseif(strpos($template, 'woocommerce/global/wrapper-end.php') !== false) {

				$template = WC_ABSPATH . 'templates/global/wrapper-end.php';

			} elseif(strpos($template, 'woocommerce/global/wrapper-start.php') !== false) {

				$template = WC_ABSPATH . 'templates/global/wrapper-start.php';

			} elseif(strpos($template, 'woocommerce/loop/result-count.php') !== false) {

				$template = WC_ABSPATH . 'templates/loop/result-count.php';

			} elseif(strpos($template, 'woocommerce/loop/rating.php') !== false) {

				$template = WC_ABSPATH . 'templates/loop/rating.php';

			} elseif(strpos($template, 'woocommerce/loop/add-to-cart.php') !== false) {

				$template = WC_ABSPATH . 'templates/loop/add-to-cart.php';

			} elseif(strpos($template, 'woocommerce/single-product/product-thumbnails.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/product-thumbnails.php';

			} elseif(strpos($template, 'woocommerce/single-product/product-image.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/product-image.php';

			} elseif(strpos($template, 'woocommerce/single-product/related.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/related.php';

			} elseif(strpos($template, 'woocommerce/single-product/up-sells.php') !== false) {

				$template = WC_ABSPATH . 'templates/single-product/up-sells.php';

			} elseif(strpos($template, 'woocommerce/cart/cross-sells.php') !== false) {

				$template = WC_ABSPATH . 'templates/cart/cross-sells.php';

			} elseif(strpos($template, 'woocommerce/cart/cart-shipping.php') !== false) {

				$template = WC_ABSPATH . 'templates/cart/cart-shipping.php';

			} elseif(strpos($template, 'woocommerce/myaccount/my-address.php') !== false) {

				$template = WC_ABSPATH.'templates/myaccount/my-address.php';
 
			} elseif(strpos($template, 'woocommerce/myaccount/dashboard.php') !== false) {

        		$template = WC_ABSPATH.'templates/myaccount/dashboard.php';
        
			} elseif(strpos($template, 'woocommerce/order/order-details.php') !== false) {

				$template = WC_ABSPATH.'templates/order/order-details.php';

			} elseif(strpos($template, 'woocommerce/order/order-downloads.php') !== false) {
        
        		$template = WC_ABSPATH.'templates/order/order-downloads.php';
        
			} elseif(strpos($template, 'woocommerce/content-product.php') !== false) {

				$template = WC_ABSPATH . 'templates/content-product.php'; 
        
			} elseif(strpos($template, 'woocommerce/order/order-details-customer.php') !== false) {

				$template = WC_ABSPATH.'templates/order/order-details-customer.php';

			} elseif(strpos($template, 'woocommerce/loop/pagination.php') !== false) {

				$template = WC_ABSPATH.'templates/loop/pagination.php';

			} elseif(strpos($template, 'woocommerce/myaccount/orders.php') !== false) {

				$template = WC_ABSPATH.'templates/myaccount/orders.php';

			} elseif(strpos($template, 'woocommerce/myaccount/downloads.php') !== false) {

				$template = WC_ABSPATH.'templates/myaccount/downloads.php';

			} elseif(strpos($template, 'woocommerce/checkout/terms.php') !== false) {

				$template = WC_ABSPATH.'templates/checkout/terms.php';

			}
			return $template;
		}, 999);
	}


	public function wc_breadcrumb_default_filter($iconClass) {

		add_filter('woocommerce_breadcrumb_defaults', function ($param) use ($iconClass) {

			$param['delimiter'] = '<i class="' . $iconClass . '" aria-hidden="true"></i>';
			$param['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
			$param['wrap_after'] = '</nav>';

			return $param;
		}, 999);
	}

	public function comment_template_filter_checker() {

		add_filter('comments_template', function ($template) {

			if(strpos($template, '/single-product-advanced-reviews.php') !== false) {

				/**
				 * Fix for electro theme.................
				 */

				$template = WC_ABSPATH . 'templates/single-product-reviews.php';

			} elseif(strpos($template, '/woocommerce/single-product-reviews.php') !== false) {

				/**
				 * Fix for all other theme.................
				 */

				$template = WC_ABSPATH . 'templates/single-product-reviews.php';
			}

			return $template;
		}, 999);
	}
}
