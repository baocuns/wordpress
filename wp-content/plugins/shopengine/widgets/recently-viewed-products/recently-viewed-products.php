<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use ShopEngine\Widgets\Products;

class Shopengine_Recently_Viewed_Products extends \ShopEngine\Base\Widget {

	public function config() {
		return new Shopengine_Recently_Viewed_Products_Config();
	}

    protected function register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'shopengine'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'products_per_page',
            [
                'label' => esc_html__('Products Per Page', 'shopengine' ),
                'type' => Controls_Manager::NUMBER,
                'default'   => 4,
            ]
        );

        $this->add_control(
            'product_order',
            [
                'label' => esc_html__('Order', 'shopengine'),
                'type' => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                    'ASC'       => esc_html__('ASC', 'shopengine'),
                    'DESC'      => esc_html__('DESC', 'shopengine'),
                ],
            ]
        );

        $this->add_responsive_control(
			'column',
			[
				'label'	=> esc_html__('Column', 'shopengine'),
				'type'	=> Controls_Manager::NUMBER,
				'min' 	=> 1,
				'max' 	=> 12,
				'step' 	=> 1,
				'desktop_default'	=> 4,
				'tablet_default'	=> 3,
				'mobile_default'	=> 1,
                'selectors'	=> [
					'{{WRAPPER}} .shopengine-recently-viewed-products .recent-viewed-product-list' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'shopengine'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


		$this->add_control(
			'badge_settings',
			[
				'label' => esc_html__( 'Badge:', 'shopengine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_sale',
			[
				'label'         => esc_html__('Show Sale Badge?', 'shopengine'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Yes', 'shopengine'),
				'label_off'     => esc_html__('No', 'shopengine'),
				'return_value'  => 'yes',
				'default'       => 'yes',
				'selectors'	    => [
					'{{WRAPPER}} .shopengine-single-product-item .badge.sale' => 'display: inline-block !important;'
				],
			]
		);

		$this->add_control(
			'show_tag',
			[
				'label'         => esc_html__('Show Tag', 'shopengine'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Yes', 'shopengine'),
				'label_off'     => esc_html__('No', 'shopengine'),
				'return_value'  => 'yes',
				'default'       => (isset( $default['show_tag']) ? esc_attr($default['show_tag']) : 'yes'),
				'selectors'	    => [
					'{{WRAPPER}} .shopengine-single-product-item .badge.tag' => 'display: inline-block;'
				]
			]
		);

		$this->add_control(
			'badge_position',
			[
				'label' => esc_html__( 'Badge Position', 'shopengine' ),
				'type' 	=> Controls_Manager::CHOOSE,
				'options' => [
					'top-left' 	=> [
						'title'	=> esc_html__( 'Top Left', 'shopengine' ),
						'icon' 	=> 'eicon-h-align-left',
					],
					'top-right' => [
						'title'	=> esc_html__( 'Top Right', 'shopengine' ),
						'icon' 	=> 'eicon-h-align-right',
					],
					'custom' 	=> [
						'title'	=> esc_html__( 'Custom', 'shopengine' ),
						'icon' 	=> 'eicon-settings',
					],
				],
				'default'	=> 'top-right',
				'toggle' 	=> false,
				'conditions' 	=> [
					'relation'	=> 'or',
					'terms' 	=> [
						[
							'name' 		=> 'show_sale',
							'operator' 	=> '===',
							'value' 	=> 'yes'
						],
						[
							'name' 		=> 'show_tag',
							'operator' 	=> '===',
							'value' 	=> 'yes'
						]
					]
				]
			]
		);

		$this->add_control(
			'badge_position_x_axis',
			[
				'label' => esc_html__('Badge Position (X axis)', 'shopengine'),
				'type' 	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
						'step'  => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' 	=> '%',
					'size' 	=> 4,
				],
				'selectors' => [
					'{{WRAPPER}} .product-tag-sale-badge' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'badge_position' => 'custom',
				]
			]
		);

		$this->add_control(
			'badge_position_y_axis',
			[
				'label' => esc_html__('Badge Position (Y axis)', 'shopengine'),
				'type' 	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
						'step'  => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .product-tag-sale-badge' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'badge_position' => 'custom',
				]
			]
		);

		$this->add_control(
			'badge_align',
			[
				'label' => esc_html__( 'Badge Align', 'shopengine' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'vertical' => [
						'title'	=> esc_html__( 'Vertical', 'shopengine' ),
						'icon' 	=> 'eicon-navigation-vertical',
					],
					'horizontal' => [
						'title'	=> esc_html__( 'Horizontal', 'shopengine' ),
						'icon'	=> 'eicon-navigation-horizontal',
					],
				],
				'default' 	=> 'horizontal',
				'toggle' 	=> false,
				'conditions' => [
					'relation'	=> 'or',
					'terms' => [
						[
							'name' => 'show_sale',
							'operator'	=> '===',
							'value' 	=> 'yes'
						],
					]
				]
			]
		);

		$this->add_control(
			'container_settings',
			[
				'label' => esc_html__( 'Title, Price and Buttons:', 'shopengine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_show_title',
			[
				'label'        => esc_html__('Show Title?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'block',
				'default'      => 'none',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .shopengine-single-product-item .product-title' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_show_price',
			[
				'label'        => esc_html__('Show Price?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'block',
				'default'      => 'none',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .shopengine-single-product-item .product-price' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_show_buttons',
			[
				'label'        => esc_html__('Show Buttons?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'block',
				'default'      => 'none',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .shopengine-single-product-item .add-to-cart-bt' => 'display: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'price_settings',
			[
				'label' => esc_html__( 'Button:', 'shopengine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'shopengine_show_buttons' => 'block',
				]
			]
		);

		$this->add_control(
			'shopengine_cart_button',
			[
				'label'        => esc_html__('Cart Button', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-single-product-item .add-to-cart-bt .button' => 'display: inline-block;',
				],
				'condition' => [
					'shopengine_show_buttons' => 'block',
				]
			]
		);

        $this->end_controls_section();

        /**
         * @params - These are common style sections: wrapper, badge, image, category, title, rating, price, description, cart
         */

        $this->start_controls_section(
            'product_wrap_style_section',
            [
                'label' => esc_html__('Product Wrap', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_responsive_control(
			'shopengine_recent_product_text_align',
			[
				'label'     => esc_html__('Text Align', 'shopengine'),
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
				'selectors_dictionary' => [
					'left'   => 'text-align: left; justify-content: flex-start;',
					'center' => 'text-align: center; justify-content: center;',
					'right'  => 'text-align: right; justify-content: flex-end;',
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .recent-viewed-product-list :is(.shopengine-single-product-item, .price)' => '{{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'product_item_column_gap',
			[
                'label' => esc_html__('Column Gap (px)', 'shopengine'),
                'type' 	=> Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
				'default'       => [
                    'unit'  => 'px',
                    'size'  => '20',
                ],
				'selectors' => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .recent-viewed-product-list' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
        );

		$this->add_responsive_control(
			'product_item_row_gap',
			[
                'label' => esc_html__('Row Gap (px)', 'shopengine'),
                'type' 	=> Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
				'default'       => [
                    'unit'  => 'px',
                    'size'  => '20',
                ],
				'selectors' => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .recent-viewed-product-list' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
        );

        $this->add_responsive_control(
            'product_wrap_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' 		=> 0,
                    'right' 	=> 0,
                    'bottom'	=> 0,
                    'left' 		=> 0,
                    'unit' 		=> 'px',
                    'isLinked' 	=> true,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .shopengine-recently-viewed-products .shopengine-single-product-item .product-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_image_bg',
            [
                'label'     => esc_html__('Image Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-thumb' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_wrap_border',
                'label' => esc_html__('Border', 'shopengine'),
                'selector' => '{{WRAPPER}} .shopengine-recently-viewed-products .shopengine-single-product-item',
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'shopengine_product_wrap_hide_right_border',
			[
				'label'         => esc_html__('Hide Right Boder?', 'shopengine'),
				'description'   => esc_html__('If the column gap is zero, you may hide the right border. So that right and left border will not double.', 'shopengine'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Yes', 'shopengine'),
				'label_off'     => esc_html__('No', 'shopengine'),
				'return_value'  => 'yes',
				'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} .shopengine-recently-viewed-products .shopengine-single-product-item:not(:last-child)' => 'border-right: none;',
                ],
				'condition'     => [
					'product_wrap_border_border!' => '',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'product_image_style_section',
            [
                'label' => esc_html__('Product Image', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'product_image_use_equal_height',
			[
				'label'         => esc_html__('Use equal height for all image', 'shopengine'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Yes', 'shopengine'),
				'label_off'     => esc_html__('No', 'shopengine'),
				'return_value'  => 'yes',
			]
		);

        $this->add_control(
            'product_image_fit',
            [
                'label' => esc_html__('Image fit', 'shopengine'),
                'type' => Controls_Manager::SELECT,
                'default'   => 'contain',
                'options'   => [
                    'contain'  => esc_html__('Contain', 'shopengine'),
                    'cover'    => esc_html__('Cover', 'shopengine'),
                ],
                'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-thumb img'   => 'object-fit: {{VALUE}};'
				],
                'condition' => [
                    'product_image_use_equal_height' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
			'product_image_height',
			[
				'label' => esc_html__( 'Image height', 'shopengine' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 180,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-thumb img'   => 'height: {{SIZE}}{{UNIT}};'
				],
                'condition' => [
                    'product_image_use_equal_height' => 'yes'
                ]
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(
            'product_badge_style_section',
            [
                'label' => esc_html__('Product Badge', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'show_sale',
                            'operator' => '===',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'show_tag',
                            'operator' => '===',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_badge_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link',
                'exclude'  => ['font_style', 'text_decoration'],
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '12',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px']
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'default'   => [
                            'size'  => '24',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ],
            )
        );

        $this->add_control(
            'product_badge_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_badge_bg',
            [
                'label'     => esc_html__('Badge Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f03d3f',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_percentage_badge_bg',
            [
                'label'     => esc_html__('Percentage Badge Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .off' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
			'product_badgey_item_space_between',
			[
				'label' => esc_html__( 'Space In-between
                Item (px)', 'shopengine' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .product-tag-sale-badge ul li:not(:last-child)'   => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .product-tag-sale-badge.align-vertical ul li:not(:last-child)'   => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
				],
                'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'product_badge_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_badge_margin',
            [
                'label'			=> esc_html__( 'Margin (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'label' => esc_html__( 'Border', 'shopengine' ),
                'selector' => '{{WRAPPER}} .product-tag-sale-badge :is(.tag, a, .no-link, li)'
            ]
        );
        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'shopengine' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3' ,
                    'left' => '3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // hover overlay style start
        $this->start_controls_section(
            'product_hover_overlay_style_section',
            [
                'label' => esc_html__('Product Hover', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_product_hover_overlay!'  => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
			'product_hover_overlay_color_tabs'
		);

		$this->start_controls_tab(
			'product_hover_overlay_color_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

        $this->add_control(
            'product_hover_overlay_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#101010',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a::before'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a::after'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_hover_overlay_bg_color',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a' => 'background: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'product_hover_overlay_color_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

        $this->add_control(
            'product_hover_overlay_hover_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F03D3F',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a.added::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a.loading::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a:hover::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a:hover::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_hover_overlay_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
			'product_hover_overlay_font_size',
			[
				'label' => esc_html__( 'Font Size (px)', 'shopengine' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .overlay-add-to-cart a::before'    => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart a::after'     => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

        $this->add_responsive_control(
            'product_hover_overlay_padding',
            [
                'label'			=> esc_html__( 'Item Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '10',
                    'right' => '22',
                    'bottom' => '10',
                    'left' => '22',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .overlay-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
			'product_hover_overlay_item_space_between',
			[
				'label' => esc_html__( 'Space In-between
                Items (px)', 'shopengine' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .overlay-add-to-cart.position-bottom a:not(:last-child)'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-left a:not(:last-child)'     => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-right a:not(:last-child)'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-center a:not(:nth-child(2n))'    => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-center a:not(:nth-child(1), :nth-child(2))'    => 'margin-top: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_hover_overlay_border',
                'label' => esc_html__('Border', 'shopengine'),
                'fields_options' => [
                    'border'     => [
                        'default' => '',
                        'selectors' => [
                            '{{SELECTOR}} .overlay-add-to-cart' => 'border-style: {{VALUE}};',
                            '{{SELECTOR}} .overlay-add-to-cart:not(:last-child)' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '0',
                            'right'     => '0',
                            'bottom'    => '0',
                            'left'      => '0',
                            'isLinked'  => true,
                        ],
                        'selectors' => [
                            '{{SELECTOR}} .overlay-add-to-cart' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-width: 0 {{RIGHT}}{{UNIT}} 0 0;',
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2',
                        'alpha'   => false,
                        'selectors' => [
                            '{{SELECTOR}} .overlay-add-to-cart' => 'border-color: {{VALUE}};',
                            '{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-color: {{VALUE}};',
                        ],
                    ]
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_border_radius',
            [
                'label'			=> esc_html__( 'Border Radius (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .overlay-add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_margin',
            [
                'label'			=> esc_html__( 'Wrap Margin (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .overlay-add-to-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        // hover overlay style end

        /*
		 * Style Tab - Products Title
		 */
		$this->start_controls_section(
			'shopengine_product_title_section',
			[
				'label' => esc_html__('Product Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_title' => 'block',
				]
			]
		);

		$this->add_control(
			'shopengine_product_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_title_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-single-product-item .product-title a',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '20',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_title_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '5',
					'bottom'   => '0',
					'left'     => '5',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-single-product-item .product-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

        /*
		 * Style Tab - Products Price
		 */
		$this->start_controls_section(
			'shopengine_product_price_section',
			[
				'label' => esc_html__('Product Price', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_price' => 'block',
				]
			]
		);

		$this->add_control(
			'shopengine_product_price_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-price :is(.price, .price span, .price .amount)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_sale_price_color',
			[
				'label'     => esc_html__('Sale Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-price :is(del span, del .amount)' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'         	=> 'shopengine_product_price_typography',
				'selector'    	=> '{{WRAPPER}} .shopengine-single-product-item .product-price :is(.price, .price .amount, .price ins, .price del)',
				'exclude'		=> ['text_transform', 'text_decoration', 'font_style', 'word_spacing'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '700',
					],
					'font_size'       => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'	=> [
							'size' => '18',
							'unit' => 'px'
						]
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '24',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_price_space_between',
			[
				'label'      => esc_html__('Space In-between
				(px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'size' => 8,
					'unit' => 'px'
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-recently-viewed-products .product-price .price del'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-recently-viewed-products .product-price .price .shopengine-discount-badge'   => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_product_price_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '8',
					'right'    => '5',
					'bottom'   => '0',
					'left'     => '5',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-single-product-item .product-price .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

        /*
		 * Style Tab - Price Discount Badge
		 */
        $this->add_control(
			'shopengine_product_price_discount_badge_style',
			[
				'label'     => esc_html__('Discount Badge', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__('Discount badge shows when Badges module is on', 'shopengine'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_price_discount_badge_typography',
				'selector'       => '{{WRAPPER}} .shopengine-single-product-item .product-price .price .shopengine-discount-badge',
				'exclude'		=> ['text_decoration', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '400',
					],
					'font_size'       => [
						'size_units' => ['px'],
						'default' => [
							'size' => '12',
							'unit' => 'px'
						]
					],
					'text_transform'  => [
						'default' => 'uppercase',
					],
					'line_height'     => [
						'size_units' => ['px'],
						'default' => [
							'size' => '20',
							'unit' => 'px'
						]
					],
					'letter_spacing'  => [
						'default' => [
							'size' => '',
						]
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-price .price .shopengine-discount-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#EA4335',
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item .product-price .price .shopengine-discount-badge' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_price_discount_badge_padding',
			[
				'label'	=> esc_html__( 'Badge Padding (px)', 'shopengine' ),
				'type'	=> Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '5',
					'bottom'   => '0',
					'left'     => '5',
					'isLinked' => false,
				],
				'selectors'	=> [
					'{{WRAPPER}} .shopengine-single-product-item .product-price .price .shopengine-discount-badge' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'shopengine_recent_product_add_cart_btn_section',
			[
				'label' => esc_html__('Add To Cart', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_buttons' => 'block',
				]
			]
		);

		$this->add_control(
			'shopengine_recent_product_btns_space_between',
			[
				'label'   		=> esc_html__('Space In-between (px)', 'shopengine'),
				'type'    		=> Controls_Manager::SLIDER,
				'size_units'	=> ['px'],
				'range'			=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 50,
						'step'	=> 1,
					],
				],
				'default'		=> [
					'unit'	=> 'px',
					'size'	=> 4,
				],
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item .add-to-cart-bt a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_recent_product_add_cart_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'default'    => [
							'size' => '13',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
					],
				],
				'separator'      => 'before',
			]
		);

		$this->start_controls_tabs(
			'shopengine_recent_product_add_cart_btn_style_tabs',
			[
                'separator'	=> 'before',
			]
		);

		$this->start_controls_tab(
			'shopengine_recent_product_add_cart_btn_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_recent_product_add_cart_btn_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_recent_product_add_cart_btn_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3E3E3E',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_recent_product_add_cart_btn_tab_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_recent_product_add_cart_btn_hover_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_recent_product_add_cart_btn_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#332d2d',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_recent_product_add_cart_btn_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'shopengine_recent_product_add_cart_btn_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '8',
					'right'    => '15',
					'bottom'   => '8',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'shopengine_recent_product_add_cart_border',
				'label'     => esc_html__('Border', 'shopengine'),
				'selector'  => '{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)',
                'separator'	=> 'before',
			]
		);

		$this->add_control(
			'shopengine_recent_product_add_cart_border_radius',
			[
				'label'     => esc_html__('Border Radius (px)', 'shopengine'),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'   => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_recent_product_add_cart_btn_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .recent-viewed-product-list .shopengine-single-product-item :is(.button, .added_to_cart)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

    }

	protected function screen() {
        $settings = $this->get_settings_for_display();

		$post_type = get_post_type();
		$product = Products::instance()->get_product($post_type);
		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
    }
}
