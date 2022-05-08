<?php

namespace Elementor;


use ShopEngine\Core\Register\Model;
use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Add_To_Cart extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Add_To_Cart_Config();
	}


	protected function register_controls() {

		$m_settings = Model::source('settings')->get_option('modules', []);

		/*
			--------------------------
			settings content tab
			--------------------------
		*/ 
		
		$this->start_controls_section(
			'shopengine_add_to_cart_settings',
			[
				'label' => esc_html__('Settings', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		/*
			------------------------------
			Quantity Section start
			------------------------------
		*/
        
		$this->add_control(
			'shopengine_add_to_cart_quantity_section',
			[
				'label'     => esc_html__('Quantity Settings', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
			]
		);
        
        $this->add_control(
            'shopengine_quantity_btn_position',
            [
                'label'   => esc_html__('Button Style', 'shopengine'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'   => esc_html__('Default', 'shopengine'),
                    'both'      => esc_html__('Both Side', 'shopengine'),
                    'before'    => esc_html__('Both Left', 'shopengine'),
                    'after'     => esc_html__('Both Right', 'shopengine'),
                ],
            ]
        );

		$this->add_control(
			'shopengine_quantity_plus_icon',
			[
				'label'   => esc_html__('Plus Icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'condition' => [
					'shopengine_quantity_btn_position!' => 'default',
				]
			]
		);

		$this->add_control(
			'shopengine_quantity_minus_icon',
			[
				'label'   => esc_html__('Minus Icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-minus',
					'library' => 'fa-solid',
				],
				'condition' => [
					'shopengine_quantity_btn_position!' => 'default',
				]
			]
		);
        
		/*
			------------------------------
			Contents Section start
			------------------------------
		*/

		$this->add_control(
			'shopengine_add_to_cart_stock_section',
			[
				'label'     => esc_html__('Stock', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'shopengine_add_to_cart_show_stock',
            [
                'label'        => esc_html__('Show Stock Status', 'shopengine'),
                'description'  => esc_html__('Show stock status, If product have stock enable.', 'shopengine'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'shopengine'),
                'label_off'    => esc_html__('No', 'shopengine'),
                'default'      => "yes",
                'return_value' => "yes",
                'selectors'    => [
                    '{{WRAPPER}} .shopengine-swatches .stock' => 'display: block;',
                ],
            ]
        );
        
		/*
			------------------------------
			Variations Section start
			------------------------------
		*/

		$this->add_control(
			'shopengine_add_to_cart_variation_section',
			[
				'label'     => esc_html__('Variations', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'shopengine_add_to_cart_show_variation_description',
            [
                'label'        => esc_html__('Variation Description', 'shopengine'),
                'description'  => esc_html__('Show product variation description.', 'shopengine'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'shopengine'),
                'label_off'    => esc_html__('No', 'shopengine'),
                'default'      => "yes",
                'return_value' => "yes",
                'selectors'    => [
                    '{{WRAPPER}} .shopengine-swatches .woocommerce-variation-description' => 'display: block;',
                ],
            ]
        );
        
		/*
			------------------------------
			Data ordering Section start
			------------------------------
		*/
		$this->add_control(
			'shopengine_add_to_cart_data_ordering_section',
			[
				'label'     => esc_html__('Data Ordering', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'shopengine_add_to_cart_data_ordering_enable',
            [
                'label'        => esc_html__('Enable Ordering?', 'shopengine'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'shopengine'),
                'label_off'    => esc_html__('No', 'shopengine'),
                'default'      => "yes",
                'return_value' => "yes",
                'selectors'    => [
                    '{{WRAPPER}} .shopengine-swatches' => 'display: block;',
                    '{{WRAPPER}} .shopengine-swatches .grouped_form .group_table' => 'order: -99;',
                ],
            ]
        );

		$default = [
			[
				'list_title' => esc_html__( 'Quantitly', 'shopengine' ),
				'list_key' => 'quantity',
			],
			[
				'list_title' => esc_html__( 'Add to Cart', 'shopengine' ),
				'list_key' => 'add_to_cart',
			],
			[
				'list_title' => esc_html__( 'Buy Now/Quick Checkout', 'shopengine' ),
				'list_key' => 'quick_checkout',
			],
			[
				'list_title' => esc_html__( 'Wishlist', 'shopengine' ),
				'list_key' => 'wishlist',
			],
			[
				'list_title' => esc_html__( 'Comparison', 'shopengine' ),
				'list_key' => 'comparison',
			],
			[
				'list_title' => esc_html__( 'Partial Payment', 'shopengine' ),
				'list_key' => 'partial_payment',
			],
		];
		
		$repeater = new Repeater();
		$this->add_control(
			'shopengine_add_to_cart_data_ordering_list',
			[
				'label' => esc_html__( 'Data Ordering List', 'shopengine' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => $default,
				'title_field' => '{{{ list_title }}}',
				'item_actions' => [
					'add'       => false,
					'duplicate' => false,
					'remove'    => false,
					'sort'      => true,
				],
				'condition' => [
					'shopengine_add_to_cart_data_ordering_enable' => 'yes',
				]
			]
		);

		$this->end_controls_section();
		// contents section end

		/*
		* Style Tab - Stock Style
		*/
		$this->start_controls_section(
			'shopengine_section_add_to_cart_stock_status_styles',
			[
                'label' => esc_html__('Stock Status', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_add_to_cart_show_stock'  => 'yes'
				]
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_add_to_cart_stock_status_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches .stock',
				'exclude'        => ['font_style', 'text_decoration', 'letter_spacing'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_size'   => [
                        'label' => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '14',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'font_weight' => [
						'default' => '500',
					],
					'line_height' => [
                        'label' => esc_html__('Line Height (px)', 'shopengine'),
						'default'   => [
							'size'  => '17',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
				],
			)
		);

        $this->add_responsive_control(
            'shopengine_add_to_cart_stock_status_alignment',
            [
                'label'     => esc_html__('Alignment', 'shopengine'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'shopengine'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'shopengine'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'shopengine'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .stock' => 'text-align: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'shopengine_add_to_cart_in_stock_color',
			[
				'label'     => esc_html__('In Stock Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#169543',
				'description'   => esc_html__('This will apply to product in stock', 'shopengine'),
				'selectors'     => [
					'{{WRAPPER}} .shopengine-swatches .stock' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_out_of_stock_color',
			[
				'label'     => esc_html__('Out Of Stock Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#EA4335',
				'description'   => esc_html__('This will apply to product out of stock', 'shopengine'),
				'selectors'     => [
					'{{WRAPPER}} .shopengine-swatches .stock.out-of-stock' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

        /*
        * Style Tab - Add to Cart Button
        */
        $this->start_controls_section(
            'shopengine_section_add_cart__button_style',
            array(
                'label' => esc_html__('Add To Cart Button', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'           => 'shopengine_add_cart_button_typography',
                'label'          => esc_html__('Typography', 'shopengine'),
                'selector'       => '{{WRAPPER}} .shopengine-swatches .cart  .button',
				'exclude'        => ['text_decoration'],
                'fields_options' => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'    => [
                        'default' => '600',
                    ],
                    'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
                        'default'    => [
                            'size' => '15',
                            'unit' => 'px'
                        ],
                        'size_units' => ['px']
                    ],
                    'text_transform' => [
                        'default' => 'uppercase',
                    ],
                    'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
                        'default'    => [
                            'size' => '18',
                            'unit' => 'px'
                        ],
						'size_units' => ['px'],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'selectors'  => [
							'{{WRAPPER}} .shopengine-swatches .cart  .button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
						],
                    ],
                ],
            )
        );

        $this->start_controls_tabs('shopengine_add_cart_button_style_tabs');

        $this->start_controls_tab('shopengine_add_cart_button_style_normal',
            [
                'label' => esc_html__('Normal', 'shopengine'),
            ]
        );

        $this->add_control(
            'shopengine_add_cart_button_text_color_normal',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .cart .button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shopengine_add_cart_button_bg_color_normal',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .cart .button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('shopengine_add_cart_button_style_hover',
            [
                'label' => esc_html__('Hover', 'shopengine'),
            ]
        );

        $this->add_control(
            'shopengine_add_cart_button_text_color_hover',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .cart .button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shopengine_add_cart_button_bg_color_hover',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#312b2b',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .cart  .button:hover' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'shopengine_add_cart_button_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#312b2b',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .cart  .button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'shopengine_add_cart_button_border',
                'selector'       => '{{WRAPPER}} .shopengine-swatches .cart  .button',
				'size_units'     => ['px'],
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'default' => [
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						],
					],
					'color'  => [
						'default' => '#101010',
						'alpha'		=> false,
					]
				],
				'separator'  => 'before',
            ]
        );

        $this->add_control(
            'shopengine_add_cart_button_border_radius',
            [
                'label'      => esc_html__('Border Radius (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '5',
                    'left'     => '5',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .cart  .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shopengine_add_cart_button_padding',
            [
                'label'      => esc_html__('Padding (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '12',
                    'right'    => '25',
                    'bottom'   => '12',
                    'left'     => '25',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .cart .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
				'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'shopengine_add_cart_button_margin',
            [
                'label'      => esc_html__('Margin (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '10',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .cart .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
				'separator'  => 'before',
            ]
        );

        $this->end_controls_section();

		if(empty($m_settings['quick-checkout']['status']) || !empty($m_settings['quick-checkout']['status']) && $m_settings['quick-checkout']['status'] === 'active') {

			/*
			* Style Tab - Quick Checkout Button
			*/
			$this->start_controls_section(
				'shopengine_section_quick_checkout_button_style',
				array(
					'label' => esc_html__('Quick Checkout', 'shopengine'),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);
	
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'           => 'shopengine_quick_checkout_button_typography',
					'label'          => esc_html__('Typography', 'shopengine'),
					'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button',
					'exclude'        => ['text_decoration'],
					'fields_options' => [
						'typography'     => [
							'default' => 'custom',
						],
						'font_weight'    => [
							'default' => '600',
						],
						'font_size'      => [
							'label'      => esc_html__('Font Size (px)', 'shopengine'),
							'default'    => [
								'size' => '15',
								'unit' => 'px'
							],
							'size_units' => ['px']
						],
						'text_transform' => [
							'default' => 'uppercase',
						],
						'line_height'    => [
							'label'      => esc_html__('Line Height (px)', 'shopengine'),
							'default'    => [
								'size' => '18',
								'unit' => 'px'
							],
							'size_units' => ['px'],
							'tablet_default' => [
								'unit' => 'px',
							],
							'mobile_default' => [
								'unit' => 'px',
							],
							'selectors'  => [
								'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
							],
						],
					],
				)
			);
	
			$this->start_controls_tabs('shopengine_quick_checkout_button_style_tabs');
	
			$this->start_controls_tab('shopengine_quick_checkout_button_style_normal',
				[
					'label' => esc_html__('Normal', 'shopengine'),
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_text_color_normal',
				[
					'label'     => esc_html__('Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_bg_color_normal',
				[
					'label'     => esc_html__('Background Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button' => 'background-color: {{VALUE}} !important;',
					],
				]
			);
	
			$this->end_controls_tab();
	
			$this->start_controls_tab('shopengine_quick_checkout_button_style_hover',
				[
					'label' => esc_html__('Hover', 'shopengine'),
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_text_color_hover',
				[
					'label'     => esc_html__('Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button:hover' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_bg_color_hover',
				[
					'label'     => esc_html__('Background Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#312b2b',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button:hover' => 'background-color: {{VALUE}} !important;',
					],
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_border_color_hover',
				[
					'label'     => esc_html__('Border Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#312b2b',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button:hover' => 'border-color: {{VALUE}};',
					],
				]
			);
	
			$this->end_controls_tab();
			$this->end_controls_tabs();
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'shopengine_quick_checkout_button_border',
					'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button',
					'size_units'     => ['px'],
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width'  => [
							'default' => [
								'top'      => '1',
								'right'    => '1',
								'bottom'   => '1',
								'left'     => '1',
								'isLinked' => true,
							],
						],
						'color'  => [
							'default' => '#101010',
							'alpha'		=> false,
						]
					],
					'separator'  => 'before',
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_border_radius',
				[
					'label'      => esc_html__('Border Radius (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'default'    => [
						'top'      => '5',
						'right'    => '5',
						'bottom'   => '5',
						'left'     => '5',
						'unit'     => 'px',
						'isLinked' => true,
					],
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_control(
				'shopengine_quick_checkout_button_padding',
				[
					'label'      => esc_html__('Padding (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'      => '12',
						'right'    => '25',
						'bottom'   => '12',
						'left'     => '25',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
					'separator'  => 'before',
				]
			);
	
			$this->add_responsive_control(
				'shopengine_quick_checkout_button_margin',
				[
					'label'      => esc_html__('Margin (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'      => '0',
						'right'    => '10',
						'bottom'   => '0',
						'left'     => '0',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-quick-checkout-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
					'separator'  => 'before',
				]
			);
	
			$this->end_controls_section();
		}

        /*
		* Style Tab - Quantity
		*/
        $this->start_controls_section(
            'shopengine_section_add_cart_quantity_style',
            array(
                'label' => esc_html__('Quantity Input', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'           => 'shopengine_add_cart_quantity_typography',
                'label'          => esc_html__('Typography', 'shopengine'),
                'selector'       => '{{WRAPPER}} .shopengine-swatches .quantity .qty',
                'exclude'		 => ['text_transform', 'line_height', 'text_decoration'],
                'fields_options' => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'    => [
                        'default' => '500',
                    ],
                    'font_size'      => [
                        'default'    => [
                            'size' => '16',
                            'unit' => 'px'
                        ],
                        'label'      => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px']
                    ],
                    'line_height'    => [
                        'default'    => [
                            'size' => '19',
                            'unit' => 'px'
                        ],
                        'label'      => esc_html__('Line Height (px)', 'shopengine'),
                        'size_units' => ['px']
                    ],
					'letter_spacing'  => [
						'default' => [
							'size' => '0.5',
						]
					],
                ],
            )
        );

        $this->add_control(
            'shopengine_add_cart_quantity_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .quantity .qty' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'shopengine_add_cart_quantity_bg_color',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches .quantity .qty' => 'background: {{VALUE}}',
                ],
            ]
        );
        
		$this->add_control(
			'shopengine_quantity_plus_minus_section_heading',
			[
				'label'     => esc_html__('Plus Minus Button', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'shopengine_quantity_btn_position!'  => 'default'
				],
                'separator'  => 'before',
			]
		);

        $this->add_control(
            'shopengine_quantity_btn_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'shopengine'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches :is(.plus, .minus) :is(i, svg)' => 'width: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};'
                ],
				'condition' => [
					'shopengine_quantity_btn_position!'  => 'default'
				],
            ]
        );

        $this->start_controls_tabs(
			'shopengine_quantity_btn_tabs',
			[
				'condition' => [
					'shopengine_quantity_btn_position!'  => 'default'
				],
			]
		);

        $this->start_controls_tab('shopengine_quantity_btn_tabs_normal',
            [
                'label' => esc_html__('Normal', 'shopengine'),
            ]
        );

        $this->add_control(
            'shopengine_quantity_btn_tabs_normal_clr',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches :is(.plus, .minus) :is(i, svg, path)' => 'color: {{VALUE}}; fill: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'shopengine_quantity_btn_tabs_normal_bg_clr',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches :is(.plus, .minus)' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('shopengine_quantity_btn_tabs_hover',
            [
                'label' => esc_html__('Hover', 'shopengine'),
            ]
        );

        $this->add_control(
            'shopengine_quantity_btn_tabs_Hover_clr',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches :is(.plus, .minus):hover :is(i, svg, path)' => 'color: {{VALUE}}; fill: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'shopengine_quantity_btn_tabs_hover_bg_clr',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches :is(.plus, .minus):hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'shopengine_quantity_button_padding',
            [
                'label'      => esc_html__('Buttons Padding (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '4',
                    'right'    => '18',
                    'bottom'   => '4',
                    'left'     => '18',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches :is(.plus, .minus)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition' => [
					'shopengine_quantity_btn_position!'  => 'default'
				],
				'separator'  => 'before',
            ]
        );

        $this->add_control(
            'shopengine_add_cart_quantity_padding',
            [
                'label'      => esc_html__('Input Padding (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '10',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .quantity .qty' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'shopengine_add_cart_quantity_border',
                'label'          => esc_html__('Border (px)', 'shopengine'),
                'size_units'     => ['px'],
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
						'selectors'    => [
							'{{WRAPPER}} .shopengine-swatches .quantity .qty'			=> 'border-style: {{VALUE}};',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap button'	=> 'border-style: {{VALUE}};',
						],
                    ],
                    'width'  => [
                        'default' => [
                            'top'      => '2',
                            'right'    => '2',
                            'bottom'   => '2',
                            'left'     => '2',
                            'isLinked' => true,
                        ],
						'selectors' => [
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.default .quantity .qty'	=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.both .quantity .qty'		=> 'border-width: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.both .minus'				=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.both .plus'				=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.before .quantity .qty'		=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.before .plus'				=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.before .minus'				=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.after .quantity .qty'		=> 'border-width: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.after .plus'				=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap.after .minus'				=> 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
                    ],
                    'color'  => [
                        'default'	=> '#F2F2F2',
						'alpha'		=> false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-swatches .quantity .qty'			=> 'border-color: {{VALUE}};',
							'{{WRAPPER}} .shopengine-swatches .quantity-wrap button'	=> 'border-color: {{VALUE}};',
						],
                    ]
                ],
                'separator'	=> 'before',
            ]
        );

        $this->add_control(
            'shopengine_add_cart_quantity_border_radius',
            [
                'label'      => esc_html__('Border Radius (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '5',
                    'left'     => '5',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .quantity-wrap.default .quantity .qty'	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .shopengine-swatches .quantity-wrap.both .quantity .qty'		=> 'border-radius: 0;',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.both .minus'				=> 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.both .plus'				=> 'border-radius: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.before .quantity .qty'		=> 'border-radius: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.before .plus'				=> 'border-radius: {{TOP}}{{UNIT}} 0 0 0;',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.before .minus'				=> 'border-radius: 0 0 0 {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.after .quantity .qty'		=> 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.after .plus'				=> 'border-radius: 0 {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .shopengine-swatches .quantity-wrap.after .minus'				=> 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} 0;',
					'.rtl {{WRAPPER}} .shopengine-swatches .quantity-wrap.both .minus'				=> 'border-radius: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;',
					'.rtl {{WRAPPER}} .shopengine-swatches .quantity-wrap.both .plus'				=> 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'shopengine_add_cart_quantity_wrap_margin',
            [
                'label'      => esc_html__('Wrap Margin (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '10',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .quantity-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->end_controls_section();


		/*
		* Style Tab - Variations
		*/
		$this->start_controls_section(
			'shopengine_section_add_to_cart_variations_styles',
			array(
				'label' => esc_html__('Variations', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

        $this->add_responsive_control(
            'shopengine_add_to_cart_variation_swatches_alignment',
            [
                'label'     => esc_html__('Alignment', 'shopengine'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'shopengine'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'shopengine'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'shopengine'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-swatches table.variations'	=> 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .shopengine-swatches .single_variation_wrap'	=> 'text-align: {{VALUE}}',
                ],
            ]
        );

		$this->start_controls_tabs('shopengine_add_to_cart_variation_tabs',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
            'shopengine_add_to_cart_variation_label_tab',
            [
                'label' => esc_html__('Label', 'shopengine'),
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_add_to_cart_variation_label_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches .variations label, {{WRAPPER}} .shopengine-swatches .variations select',
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
                        'label' => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '14',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
					'line_height' => [
                        'label' => esc_html__('Line Height (px)', 'shopengine'),
						'default'   => [
							'size'  => '18',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
				],
			)
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .variations td label'	=> 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-swatches .variations select'	=> 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
            'shopengine_add_to_cart_variation_label_display_style',
            [
                'label'   => esc_html__('Display Style', 'shopengine'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'row',
                'options' => [
                    'row'		=> esc_html__('Inline', 'shopengine'),
                    'column'	=> esc_html__('Block', 'shopengine'),
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .variations tr' => 'flex-direction: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'shopengine_add_to_cart_variation_inline_label_width',
			[
				'label'      => esc_html__('Label Width (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 60,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .variations td.label' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-swatches .variations td.value' => 'width: 100%;',
				],
				'condition' => [
					'shopengine_add_to_cart_variation_label_display_style'  => 'row'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'shopengine_add_to_cart_variation_description_tab',
            [
                'label' => esc_html__('Description', 'shopengine'),
				'condition' => [
					'shopengine_add_to_cart_show_variation_description' => 'yes',
				]
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_add_to_cart_variation_description_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches .woocommerce-variation-description',
				'exclude'		 => ['font_family', 'font_style', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
                        'label' => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '14',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
					'line_height' => [
                        'label' => esc_html__('Line Height (px)', 'shopengine'),
						'default'   => [
							'size'  => '18',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
				],
			)
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_description_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#666666',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .woocommerce-variation-description p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_add_to_cart_variation_description_margin',
			[
				'label'      => esc_html__('Description Wrap Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .woocommerce-variation-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'shopengine_add_to_cart_variation_price_tab',
            [
                'label' => esc_html__('Price', 'shopengine'),
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_add_to_cart_variation_price_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches :is(.price, .price del, .price ins )',
				'exclude'		 => ['text_transform'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '700',
					],
					'font_size'   => [
                        'label' => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '18',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
					'line_height' => [
                        'label' => esc_html__('Line Height (px)', 'shopengine'),
						'default'   => [
							'size'  => '24',
							'unit'  => 'px'
						],
						'size_units' => ['px']
					],
				],
			)
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_price_color',
			[
				'label'     => esc_html__('Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches :is(.price, .price del, .price ins )' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_sale_price_color',
			[
				'label'     => esc_html__('Sale Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .price ins .amount' => 'background: transparent; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_price_discount_badge_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__(' Discount badge shows up when a product has a sale price.', 'shopengine'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'separator'		  => 'before',
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_price_discount_badge_color',
			[
				'label'     => esc_html__('Discount Badge Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_price_discount_badge_bg_color',
			[
				'label'     => esc_html__('Discount Badge Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#EA4335',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine-badge' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_price_discount_badge_font_size',
			[
				'label'      => esc_html__('Badge Font Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine-badge' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_price_discount_badge_line_height',
			[
				'label'      => esc_html__('Badge Line Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine-badge' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_add_to_cart_variation_price_margin',
			[
				'label'      => esc_html__('Price Wrap Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .woocommerce-variation-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display: block;',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'shopengine_add_to_cart_variation_item_margin',
			[
				'label'      => esc_html__('Variation Item Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .variations tr' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'shopengine_add_to_cart_variation_wrap_margin',
			[
				'label'      => esc_html__('Variation Wrap Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .variations' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
        
		$this->add_control(
			'shopengine_add_to_cart_variation_dropdown',
			[
				'label'     => esc_html__('Variation Dropdown', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_dropdown_color',
			[
				'label'     => esc_html__('Dropdown Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .variations select' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_add_to_cart_variation_dropdown_border',
				'label'          => esc_html__('Border (px)', 'shopengine'),
				'size_units'     => ['px'],
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'label'	=> esc_html__('Width (px)', 'shopengine'),
						'default' => [
							'top'      => '2',
							'right'    => '2',
							'bottom'   => '2',
							'left'     => '2',
							'isLinked' => true,
						],
						'responsive' => false,
					],
					'color'  => [
						'default'	=> '#F2F2F2',
						'alpha'		=> false,
					]
				],
				'selector'       => '{{WRAPPER}} .shopengine-swatches .variations select',
				'separator' => 'before'
			]
		);

        $this->add_control(
            'shopengine_add_to_cart_variation_dropdown_border_radius',
            [
                'label'      => esc_html__('Border Radius (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-swatches .variations select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition' => [
					'shopengine_add_to_cart_variation_dropdown_border_border!'  => ''
				]
            ]
        );

		$this->end_controls_section();


		/*
		* Style Tab - Variation Swatches
		*/
		$this->start_controls_section(
			'shopengine_section_add_to_cart_variation_swatches_styles',
			array(
				'label' => esc_html__('Variation Swatches', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs('shopengine_add_to_cart_variation_swatch_tabs',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
            'shopengine_add_to_cart_variation_swatch_color_tab',
            [
                'label' => esc_html__('Color', 'shopengine'),
            ]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_color_width',
			[
				'label'      => esc_html__('Swatch Width (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch.swatch_color' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_color_height',
			[
				'label'      => esc_html__('Swatch Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch.swatch_color' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_color_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_color' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_add_to_cart_variation_swatch_color_label_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_color',
				'fields_options' => [
					'border' => [
						'default'    => 'solid',
						'devices'    => ['desktop'],
						'responsive' => true,
					],
					'width'  => [
						'devices' => ['desktop'],
						'default' => [
							'top'      => '2',
							'right'    => '2',
							'bottom'   => '2',
							'left'     => '2',
							'isLinked' => true,
						],
					],
					'color'  => [
						'label'		=> esc_html__('Border Color', 'shopengine'),
						'alpha'		=> false,
						'default'	=> '#F2F2F2',
					],
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_color_selected_label_border',
			[
				'label'     => esc_html__('Selected Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_color.selected' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'shopengine_add_to_cart_variation_swatch_image_tab',
            [
                'label' => esc_html__('Image', 'shopengine'),
            ]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_image_width',
			[
				'label'      => esc_html__('Swatch Width (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch.swatch_image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_image_height',
			[
				'label'      => esc_html__('Swatch Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch.swatch_image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_image_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_image' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_add_to_cart_variation_swatch_image_label_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_image',
				'fields_options' => [
					'border' => [
						'default'    => 'solid',
						'devices'    => ['desktop'],
						'responsive' => true,
					],
					'width'  => [
						'devices' => ['desktop'],
						'default' => [
							'top'      => '2',
							'right'    => '2',
							'bottom'   => '2',
							'left'     => '2',
							'isLinked' => true,
						],
					],
					'color'  => [
						'label'		=> esc_html__('Border Color', 'shopengine'),
						'alpha'		=> false,
						'default'	=> '#F2F2F2',
					],
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_image_selected_label_border',
			[
				'label'     => esc_html__('Selected Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_image.selected' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'shopengine_add_to_cart_variation_swatch_label_tab',
            [
                'label' => esc_html__('Label', 'shopengine'),
            ]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_label_width',
			[
				'label'      => esc_html__('Swatch Width (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch.swatch_label' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_label_height',
			[
				'label'      => esc_html__('Swatch Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch.swatch_label' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_label_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_label' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_add_to_cart_variation_swatch_label_label_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_label',
				'fields_options' => [
					'border' => [
						'default'    => 'solid',
						'devices'    => ['desktop'],
						'responsive' => true,
					],
					'width'  => [
						'devices' => ['desktop'],
						'default' => [
							'top'      => '2',
							'right'    => '2',
							'bottom'   => '2',
							'left'     => '2',
							'isLinked' => true,
						],
					],
					'color'  => [
						'label'		=> esc_html__('Border Color', 'shopengine'),
						'alpha'		=> false,
						'default'	=> '#F2F2F2',
					],
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_label_selected_label_border',
			[
				'label'     => esc_html__('Selected Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_label.selected' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_label_text_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#272626',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'shopengine_add_to_cart_variation_swatch_label_background_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#f1f1f1',
				'selectors' => [
					'{{WRAPPER}} .shopengine-swatches .shopengine_swatches .swatch_label' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->end_controls_section();

		if(!empty($m_settings['wishlist']['status']) && $m_settings['wishlist']['status'] === 'active') {
			
			/*
			* Style Tab - Wishlist
			*/
			$this->start_controls_section(
				'shopengine_section_add_cart_wishlist_style',
				array(
					'label' => esc_html__('Wishlist', 'shopengine'),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_size',
				[
					'label'      => esc_html__('Icon Size', 'shopengine'),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 100
						],
					],
					'default'    => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs('shopengine_add_cart_wishlist_style_tabs');

			$this->start_controls_tab(
				'shopengine_add_cart_wishlist_style_normal',
				[
					'label' => esc_html__('Normal', 'shopengine'),
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_button_color',
				[
					'label'     => esc_html__('Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge'	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_button_bg_color',
				[
					'label'     => esc_html__('Background Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge' => 'background: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'shopengine_add_cart_wishlist_style_hover',
				[
					'label' => esc_html__('Hover', 'shopengine'),
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_button_hover_color',
				[
					'label'     => esc_html__('Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches :is(.shopengine-wishlist.badge.active,.shopengine-wishlist.badge:hover)'	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_button_bg_hover_color',
				[
					'label'     => esc_html__('Background Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches :is(.shopengine-wishlist.badge.active,.shopengine-wishlist.badge:hover)' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_button_border_color_hover',
				[
					'label'     => esc_html__('Border Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches :is(.shopengine-wishlist.badge.active,.shopengine-wishlist.badge:hover)' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'shopengine_add_cart_wishlist_colors_separator',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'shopengine_add_cart_wishlist_border',
					'label'          => esc_html__('Border (px)', 'shopengine'),
					'size_units'     => ['px'],
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width'  => [
							'default' => [
								'top'      => '2',
								'right'    => '2',
								'bottom'   => '2',
								'left'     => '2',
								'isLinked' => true,
							],
						],
						'color'  => [
							'default' => '#F2F2F2',
							'alpha'		=> false,
						]
					],
					'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge',
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_border_radius',
				[
					'label'      => esc_html__('Border Radius (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'default'    => [
						'top'      => '5',
						'right'    => '5',
						'bottom'   => '5',
						'left'     => '5',
						'unit'     => 'px',
						'isLinked' => true,
					],
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_padding',
				[
					'label'      => esc_html__('Padding (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'      => '12',
						'right'    => '25',
						'bottom'   => '12',
						'left'     => '25',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_control(
				'shopengine_add_cart_wishlist_margin',
				[
					'label'      => esc_html__('Margin (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'      => '0',
						'right'    => '10',
						'bottom'   => '0',
						'left'     => '0',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-wishlist.badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();
		}

		if(!empty($m_settings['comparison']['status']) && $m_settings['comparison']['status'] === 'active') {


			/*
			* Style Tab - Compare
			*/
			$this->start_controls_section(
				'shopengine_section_add_cart_compare_style',
				array(
					'label' => esc_html__('Compare', 'shopengine'),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'shopengine_add_cart_compare_size',
				[
					'label'      => esc_html__('Icon Size', 'shopengine'),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 100
						],
					],
					'default'    => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs('shopengine_add_cart_compare_style_tabs');

			$this->start_controls_tab(
				'shopengine_add_cart_compare_style_normal',
				[
					'label' => esc_html__('Normal', 'shopengine'),
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_button_color',
				[
					'label'     => esc_html__('Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge'	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_button_bg_color',
				[
					'label'     => esc_html__('Background Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge' => 'background: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'shopengine_add_cart_compare_style_hover',
				[
					'label' => esc_html__('Hover', 'shopengine'),
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_button_hover_color',
				[
					'label'     => esc_html__('Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches :is(.shopengine-comparison.badge.active, .shopengine-comparison.badge:hover)'	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_button_bg_hover_color',
				[
					'label'     => esc_html__('Background Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches :is(.shopengine-comparison.badge.active, .shopengine-comparison.badge:hover)' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_button_border_color_hover',
				[
					'label'     => esc_html__('Border Color', 'shopengine'),
					'type'      => Controls_Manager::COLOR,
					'alpha'		=> false,
					'default'   => '#101010',
					'selectors' => [
						'{{WRAPPER}} .shopengine-swatches :is(.shopengine-comparison.badge.active, .shopengine-comparison.badge:hover)' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'shopengine_add_cart_compare_colors_separator',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'shopengine_add_cart_compare_border',
					'label'          => esc_html__('Border (px)', 'shopengine'),
					'size_units'     => ['px'],
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width'  => [
							'default' => [
								'top'      => '2',
								'right'    => '2',
								'bottom'   => '2',
								'left'     => '2',
								'isLinked' => true,
							],
						],
						'color'  => [
							'default' => '#F2F2F2',
							'alpha'		=> false,
						]
					],
					'selector'       => '{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge',
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_border_radius',
				[
					'label'      => esc_html__('Border Radius (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'default'    => [
						'top'      => '5',
						'right'    => '5',
						'bottom'   => '5',
						'left'     => '5',
						'unit'     => 'px',
						'isLinked' => true,
					],
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_padding',
				[
					'label'      => esc_html__('Padding (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'      => '12',
						'right'    => '25',
						'bottom'   => '12',
						'left'     => '25',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_control(
				'shopengine_add_cart_compare_margin',
				[
					'label'      => esc_html__('Margin (px)', 'shopengine'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'      => '0',
						'right'    => '10',
						'bottom'   => '0',
						'left'     => '0',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-swatches .shopengine-comparison.badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();
		}
	}

	private function order_item_css($order_items) {
		$styles = '';
		$parent_class = '.elementor-element-' . $this->get_id();

		foreach($order_items as $key => $item) {
			$order_number = $key + 1;
			if($item['list_key'] == 'quantity') {
				$styles .= $parent_class . ' .shopengine-swatches .quantity-wrap  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'add_to_cart') {
				$styles .= $parent_class . ' .shopengine-swatches .cart .button  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'quick_checkout') {
				$styles .= $parent_class . ' .shopengine-swatches .shopengine-quick-checkout-button  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'wishlist') {
				$styles .= $parent_class . ' .shopengine-swatches .shopengine-wishlist  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'comparison') {
				$styles .= $parent_class . ' .shopengine-swatches .shopengine-comparison  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'partial_payment') {
				$styles .= $parent_class . ' .shopengine-swatches .shopengine-partial-payment-container  {order: '. $order_number .';}';
			}
		}

		echo '<style>'.$styles.'</style>';
	}


	protected function screen() {
		?>
		<?php
		$settings = $this->get_settings_for_display();
		extract($settings);

		if(!empty($shopengine_add_to_cart_data_ordering_list)) {
			$this->order_item_css($shopengine_add_to_cart_data_ordering_list);
		}

		$post_type = get_post_type();

		$product = Products::instance()->get_product($post_type);

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
