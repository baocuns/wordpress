<?php

namespace ShopEngine\Core\Register;

use ShopEngine\Base\List_Model;
use ShopEngine\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class Module_List extends List_Model {

	use Singleton;

	protected $list_type = 'modules';

	protected function raw_list() {
		return array_merge( [
			'quick-view'                         => [
				'slug'       => 'quick-view',
				'title'      => esc_html__( 'Quick View', 'shopengine' ),
				'package'    => 'free',
				'base_class' => '\ShopEngine\Modules\Quick_View\Quick_View',
				'settings'   => [
				],
			],
			'swatches'                           => [
				'slug'       => 'swatches',
				'title'      => esc_html__( 'Swatches', 'shopengine' ),
				'package'    => 'free',
				'base_class' => '\ShopEngine\Modules\Swatches\Swatches',
				'settings'   => [],
			],
			'wishlist'                           => [
				'slug'       => 'wishlist',
				'title'      => esc_html__( 'Wishlist', 'shopengine' ),
				'package'    => 'free',
				'base_class' => '\ShopEngine\Modules\Wishlist\Wishlist',
				'settings'   => [
					'show_on_archive_page' => [
						'value'          => 'yes',
						'field_settings' => [
							'type'  => 'switch',
							'label' => esc_html__( 'Show In Archive Page', 'shopengine' ),
						]
					],
					'show_on_single_page'  => [
						'value'          => 'yes',
						'field_settings' => [
							'type'  => 'switch',
							'label' => esc_html__( 'Show In Single Page', 'shopengine' ),
						]
					],
					'show_icon_where_to' => [
						'value'          => 'before',
						'field_settings' => [
							'type'    => 'select',
							'label'   => esc_html__( 'Show Before/After Add to cart button', 'shopengine' ),
							'options' => [
								'before' => esc_html__( 'Before', 'shopengine' ),
								'after'  => esc_html__( 'After', 'shopengine' ),
							],
						]
					],
					'position'             => [
                        'value'          => 'bottom-right',
                        'field_settings' => [
                            'type'    => 'select',
                            'label'   => esc_html__('Notification Position', 'shopengine'),
                            'options' => [
                                'top-left'     => esc_html__('Top Left', 'shopengine'),
                                'top-right'    => esc_html__('Top Right', 'shopengine'),
                                'bottom-left'  => esc_html__('Bottom Left', 'shopengine'),
                                'bottom-right' => esc_html__('Bottom Right', 'shopengine')
                            ]
                        ]
                    ]
				],
			],
			'comparison'                         => [
				'slug'       => 'comparison',
				'title'      => esc_html__( 'Product Comparison', 'shopengine' ),
				'package'    => 'free',
				'base_class' => '\ShopEngine\Modules\Comparison\Comparison',
				'settings'   => apply_filters( 'shopengine/module/comparison_settings', [
					'show_on_archive_page' => [
						'value'          => 'yes',
						'field_settings' => [
							'type'  => 'switch',
							'label' => esc_html__( 'Show In Archive Page', 'shopengine' ),
						]
					],
					'show_on_single_page'  => [
						'value'          => 'yes',
						'field_settings' => [
							'type'  => 'switch',
							'label' => esc_html__( 'Show In Single Page', 'shopengine' ),
						]
					],
					'show_icon_where_to'   => [
						'value'          => 'before',
						'field_settings' => [
							'type'    => 'select',
							'label'   => esc_html__( 'Show Before/After Add to cart button', 'shopengine' ),
							'options' => [
								'before' => esc_html__( 'Before', 'shopengine' ),
								'after'  => esc_html__( 'After', 'shopengine' ),
							],
						]
					],
					'shop_field_in_table'  => [
						'value'          => [ "image", "title", "availability", "weight" ],
						'field_settings' => [
							'type'    => 'checkbox-group',
							'label'   => esc_html__( 'Select Fields to Show in Comparison Table', "shopengine" ),
							'options' => apply_filters( 'shopengine/module/comparison_fields_for_table', [
								[
									'label' => esc_html__( 'Title', 'shopengine' ),
									'value' => 'title'
								],
								[
									'label' => esc_html__( 'Description', 'shopengine' ),
									'value' => 'description'
								],
								[
									'label' => esc_html__( 'Availability', 'shopengine' ),
									'value' => 'availability'
								],
								[
									'label' => esc_html__( 'Weight', 'shopengine' ),
									'value' => 'weight'
								],
								[
									'label' => esc_html__( 'Height', 'shopengine' ),
									'value' => 'height'
								],
								[
									'label' => esc_html__( 'Dimension', 'shopengine' ),
									'value' => 'dimension'
								],
							] )
						]
					],
					'alert_one' => [
						'field_settings' => [
							'type'  => 'pro-alert',
							'value'  => '',
							'label' => '<h2> Pro Features </h2>',
							'description' => '<p>
										1. Attributes To Show<br/>
										2.  Custom Meta<br/>
										3. Share Button<br/>
										4. Show Compare Button/Bar On Bottom<br/>
										 You need to upgrade to the <strong><a href="https://wpmet.com/plugin/shopengine/pricing" target="_blank" style="color: red;">Premium</a> </strong> Version.</p>',
							'alert_type'  => 'success' //success, info, warning, error
						]
					],

				] ),
			],
		],
			$this->pro_modules_for_showing_on_free()
		);
	}

	private function pro_modules_for_showing_on_free(){

		if( class_exists('ShopEngine_Pro') ){
			return [];
		}

		return [

			'badge'                     => [
				'slug'     => 'badge',
				'title'    => esc_html__( 'Badges', 'shopengine' ),
				'package'  => 'pro-disabled',
				'status'   => 'inactive',
				'settings' => [],
			],
			'quick-checkout'            => [
				'slug'     => 'quick-checkout',
				'title'    => esc_html__( 'Quick Checkout', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [
				],
			],
			'partial-payment'           => [
				'slug'     => 'partial-payment',
				'title'    => esc_html__( 'Partial Payment', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => []
			],
			'pre-order'                 => [
				'slug'     => 'pre-order',
				'title'    => esc_html__( 'Pre-Order', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [],
			],
			'back-order'                => [
				'slug'     => 'backorder',
				'title'    => esc_html__( 'Back-Order', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [],
			],
			'sales-notification'        => [
				'slug'     => 'sales-notification',
				'title'    => esc_html__( 'Sales Notification', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [],
			],
			'currency-switcher'         => [
				'slug'     => 'currency-switcher',
				'title'    => esc_html__( 'Currency Switcher', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [],
			],
			'flash-sale-countdown'      => [
				'slug'     => 'flash-sale-countdown',
				'title'    => esc_html__( 'Flash Sale Countdown', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [],
			],
			'checkout-additional-field' => [
				'slug'     => 'checkout-additional-field',
				'title'    => esc_html__( 'Checkout Additional Field', 'shopengine' ),
				'package'  => 'pro-disabled',
				'settings' => [],
			],
			'product-size-charts'           => [
				'slug'       => 'product-size-charts',
				'title'      => esc_html__('Product Size Charts', 'shopengine'),
				'package'    => 'pro-disabled',
				'settings'   => []
			],
			'vacation'           => [
				'slug'       => 'vacation',
				'title'      => esc_html__('Vacation', 'shopengine'),
				'package'    => 'pro-disabled',
				'settings'   => []
			],
		];
	}
}
