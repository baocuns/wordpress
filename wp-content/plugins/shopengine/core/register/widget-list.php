<?php

namespace ShopEngine\Core\Register;

defined('ABSPATH') || exit;

class Widget_List extends \ShopEngine\Base\List_Model {

	use \ShopEngine\Traits\Singleton;

	protected $list_type = 'widgets';
	protected $generate_base_class = true;

	protected function raw_list() {
		return array_merge( [
			'additional-information'    => [
				'slug'    => 'additional-information',
				'title'   => esc_html__('Additional Information', 'shopengine'),
				'package' => 'free',
			],
			'add-to-cart'               => [
				'slug'    => 'add-to-cart',
				'title'   => esc_html__('Add To Cart', 'shopengine'),
				'package' => 'free',
			],
			'archive-description'       => [
				'slug'    => 'archive-description',
				'title'   => esc_html__('Archive Description', 'shopengine'),
				'package' => 'free',
			],
			'archive-products'          => [
				'slug'    => 'archive-products',
				'title'   => esc_html__('Archive Products', 'shopengine'),
				'package' => 'free',
			],
			'archive-title'             => [
				'slug'    => 'archive-title',
				'title'   => esc_html__('Archive Title', 'shopengine'),
				'package' => 'free',
			],
			'archive-result-count'      => [
				'slug'    => 'archive-result-count',
				'title'   => esc_html__('Archive Result Count', 'shopengine'),
				'package' => 'free',
			],
			'archive-view-mode'         => [
				'slug'    => 'archive-view-mode',
				'title'   => esc_html__('Archive View Mode', 'shopengine'),
				'package' => 'free',
			],
			'filter-orderby'            => [
				'slug'    => 'filter-orderby',
				'title'   => esc_html__('Order By Filter', 'shopengine'),
				'package' => 'free',
			],
			'filter-products-per-page'  => [
				'slug'    => 'filter-products-per-page',
				'title'   => esc_html__('Products Per Page Filter', 'shopengine'),
				'package' => 'free',
			],
			'breadcrumbs'               => [
				'slug'    => 'breadcrumbs',
				'title'   => esc_html__('Breadcrumbs', 'shopengine'),
				'package' => 'free',
			],
			'cart-table'                => [
				'slug'    => 'cart-table',
				'title'   => esc_html__('Cart Table', 'shopengine'),
				'package' => 'free',
			],
			'cart-totals'               => [
				'slug'    => 'cart-totals',
				'title'   => esc_html__('Cart Total', 'shopengine'),
				'package' => 'free',
			],
			'checkout-coupon-form'      => [
				'slug'    => 'checkout-coupon-form',
				'title'   => esc_html__('Checkout Form-Coupon', 'shopengine'),
				'package' => 'free',
			],
			'checkout-form-additional'  => [
				'slug'    => 'checkout-form-additional',
				'title'   => esc_html__('Checkout Form - Additional', 'shopengine'),
				'package' => 'free',
			],
			'checkout-form-billing'     => [
				'slug'    => 'checkout-form-billing',
				'title'   => esc_html__('Checkout Form - Billing', 'shopengine'),
				'package' => 'free',
			],
			'checkout-form-shipping'    => [
				'slug'    => 'checkout-form-shipping',
				'title'   => esc_html__('Checkout Form - Shipping', 'shopengine'),
				'package' => 'free',
			],
			'checkout-payment'          => [
				'slug'    => 'checkout-payment',
				'title'   => esc_html__('Checkout Payment', 'shopengine'),
				'package' => 'free',
			],
			'checkout-review-order'     => [
				'slug'    => 'checkout-review-order',
				'title'   => esc_html__('Order Review', 'shopengine'),
				'package' => 'free',
			],
			'checkout-shipping-methods' => [
				'slug'    => 'checkout-shipping-methods',
				'title'   => esc_html__('Checkout Shipping Methods', 'shopengine'),
				'package' => 'free',
			],
			'cross-sells'               => [
				'slug'    => 'cross-sells',
				'title'   => esc_html__('Cross-Sell', 'shopengine'),
				'package' => 'free',
			],
			'product-categories'        => [
				'slug'    => 'product-categories',
				'title'   => esc_html__('Product Categories', 'shopengine'),
				'package' => 'free',
			],
			'product-description'       => [
				'slug'    => 'product-description',
				'title'   => esc_html__('Product Description', 'shopengine'),
				'package' => 'free',
			],
			'product-excerpt'           => [
				'slug'    => 'product-excerpt',
				'title'   => esc_html__('Product Excerpt', 'shopengine'),
				'package' => 'free',
			],
			'product-image'             => [
				'slug'    => 'product-image',
				'title'   => esc_html__('Product Image', 'shopengine'),
				'package' => 'free',
			],
			'product-meta'              => [
				'slug'    => 'product-meta',
				'title'   => esc_html__('Product Meta', 'shopengine'),
				'package' => 'free',
			],
			'product-price'             => [
				'slug'    => 'product-price',
				'title'   => esc_html__('Product Price', 'shopengine'),
				'package' => 'free',
			],
			'product-review'            => [
				'slug'    => 'product-review',
				'title'   => esc_html__('Product Review', 'shopengine'),
				'package' => 'free',
			],
			'product-share'             => [
				'slug'    => 'product-share',
				'title'   => esc_html__('Product Share', 'shopengine'),
				'package' => 'free',
			],
			'product-sku'               => [
				'slug'    => 'product-sku',
				'title'   => esc_html__('Product SKU', 'shopengine'),
				'package' => 'free',
			],
			'product-stock'             => [
				'slug'    => 'product-stock',
				'title'   => esc_html__('Product Stock', 'shopengine'),
				'package' => 'free',
			],
			'product-tabs'              => [
				'slug'    => 'product-tabs',
				'title'   => esc_html__('Product Tabs', 'shopengine'),
				'package' => 'free',
			],
			'product-tags'              => [
				'slug'    => 'product-tags',
				'title'   => esc_html__('Product Tags', 'shopengine'),
				'package' => 'free',
			],
			'product-title'             => [
				'slug'    => 'product-title',
				'title'   => esc_html__('Product Title', 'shopengine'),
				'package' => 'free',
			],
			'product-rating'            => [
				'slug'    => 'product-rating',
				'title'   => esc_html__('Rating', 'shopengine'),
				'package' => 'free',
			],
			'related'                   => [
				'slug'    => 'related',
				'title'   => esc_html__('Related Product', 'shopengine'),
				'package' => 'free',
			],
			'return-to-shop'            => [
				'slug'    => 'return-to-shop',
				'title'   => esc_html__('Return To Shop', 'shopengine'),
				'package' => 'free',
			],
			'up-sells'                  => [
				'slug'    => 'up-sells',
				'title'   => esc_html__('Upsell', 'shopengine'),
				'package' => 'free',
			],
			'advanced-search'           => [
				'slug'    => 'advanced-search',
				'title'   => esc_html__('Advanced Search', 'shopengine'),
				'package' => 'free',
			],
			'deal-products'             => [
				'slug'    => 'deal-products',
				'title'   => esc_html__('Deal Products', 'shopengine'),
				'package' => 'free',
			],
			'filterable-product-list'   => [
				'slug'    => 'filterable-product-list',
				'title'   => esc_html__('Filterable Product List', 'shopengine'),
				'package' => 'free',
			],
			'product-category-lists'    => [
				'slug'    => 'product-category-lists',
				'title'   => esc_html__('Product Category List', 'shopengine'),
				'package' => 'free',
			],
			'product-list'              => [
				'slug'    => 'product-list',
				'title'   => esc_html__('Product List', 'shopengine'),
				'package' => 'free',
			],
			'recently-viewed-products'  => [
				'slug'    => 'recently-viewed-products',
				'title'   => esc_html__('Recently Viewed Products', 'shopengine'),
				'package' => 'free',
			],
			'view-single-product'       => [
				'slug'    => 'view-single-product',
				'title'   => esc_html__('View Single Product', 'shopengine'),
				'package' => 'free',
			],
			'notice'                    => [
				'slug'    => 'notice',
				'title'   => esc_html__('Notice', 'shopengine'),
				'package' => 'free',
			],
			'checkout-form-login'         => [
				'slug'    => 'checkout-form-login',
				'title'   => esc_html__('Checkout form login', 'shopengine'),
				'package' => 'free'
			]
		],
			$this->pro_list_for_free()
		);
	}


	private function pro_list_for_free(){

		if( class_exists('ShopEngine_Pro') ){
			return [];
		}

		return [

			'account-dashboard'          => [
				'slug'    => 'account-dashboard',
				'title'   => esc_html__( 'Account Dashboard', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-address'          => [
				'slug'    => 'account-address',
				'title'   => esc_html__( 'Account Address', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-details'          => [
				'slug'    => 'account-details',
				'title'   => esc_html__( 'Account Details', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-downloads'        => [
				'slug'    => 'account-downloads',
				'title'   => esc_html__( 'Account Downloads', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-form-login'       => [
				'slug'    => 'account-form-login',
				'title'   => esc_html__( 'Account Form - Login', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-form-register'    => [
				'slug'    => 'account-form-register',
				'title'   => esc_html__( 'Account Form - Register', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-logout'           => [
				'slug'    => 'account-logout',
				'title'   => esc_html__( 'Account Logout', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-navigation'       => [
				'slug'    => 'account-navigation',
				'title'   => esc_html__( 'Account Navigation', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-order-details'    => [
				'slug'    => 'account-order-details',
				'title'   => esc_html__( 'Account Order - Details', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'account-orders'           => [
				'slug'    => 'account-orders',
				'title'   => esc_html__( 'Account Orders', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-my_account'],
			],
			'categories'               => [
				'slug'    => 'categories',
				'title'   => esc_html__( 'Categories', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-general'],
			],
			'product-filters'          => [
				'slug'    => 'product-filters',
				'title'   => esc_html__( 'Product Filters', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-archive'],
			],
			'thankyou-address-details' => [
				'slug'    => 'thankyou-address-details',
				'title'   => esc_html__( 'Thank You Address Details', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-order'],
			],
			'thankyou-order-confirm'   => [
				'slug'    => 'thankyou-order-confirm',
				'title'   => esc_html__( 'Order Confirm', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-order'],
			],
			'thankyou-order-details'   => [
				'slug'    => 'thankyou-order-details',
				'title'   => esc_html__( 'Order Details', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-order'],
			],
			'thankyou-thankyou'        => [
				'slug'    => 'thankyou-thankyou',
				'title'   => esc_html__( 'Order Thank You', 'shopengine' ),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-order'],
			],
			'currency-switcher' => [
				'slug'	=> 'currency-switcher',
				'title' => esc_html__('Currency Switcher', 'shopengine'),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-general'],
			],
			'flash-sale-products'       => [
				'slug'    => 'flash-sale-products',
				'title'   => esc_html__('Flash Sale Products', 'shopengine'),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-general'],
			],
			'best-selling-product'       => [
				'slug'    => 'best-selling-product',
				'title'   => esc_html__('Best Selling Product', 'shopengine'),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-general'],
			],
			'comparison-button'         => [
				'slug'    => 'comparison-button',
				'title'   => esc_html__('Comparison Button', 'shopengine'),
				'package' => 'pro-disabled',
				'categories' => ['shopengine-general'],
			],
			'product-size-charts'      => [
                'slug'       => 'product-size-charts',
                'title'      => esc_html__('Product Size Chart', 'shopengine'),
                'package'    => 'pro-disabled',
                'categories' => ['shopengine-single']
            ],
			'vacation'      => [
                'slug'       => 'vacation',
                'title'      => esc_html__('Vacation', 'shopengine'),
                'package'    => 'pro-disabled',
                'categories' => ['shopengine-general']
            ],
			'advanced-coupon'      => [
                'slug'       => 'advanced-coupon',
                'title'      => esc_html__('Advanced Coupon', 'shopengine'),
                'package'    => 'pro-disabled',
                'categories' => ['shopengine-general']
            ]
		];
	}
}
