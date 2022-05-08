<?php

namespace Elementor;

use ShopEngine\Widgets\Products;
use ShopEngine\Core\Elementor_Controls\Controls_Manager as ShopEngine_Controls_Manager;

defined('ABSPATH') || exit;
class ShopEngine_Filterable_Product_List extends \ShopEngine\Base\Widget {

   public function config() {
      return new ShopEngine_Filterable_Product_List_Config();
   }

    protected function register_controls() {

        /*
            -----------------------------
            General control start
            -----------------------------
        */

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'shopengine'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
			'products_per_page',
			[
				'label' => esc_html__('Products Per Page', 'shopengine' ),
				'type'  => Controls_Manager::NUMBER,
                'default' => esc_html__('6', 'shopengine'),
			]
        );

        $this->add_responsive_control(
			'products_column_no',
			[
				'label' => esc_html__('Columns', 'shopengine' ),
				'type'  => Controls_Manager::NUMBER,
                'min'   => 1,
				'max'   => 100,
				'step'  => 1,
				'default'   => 3,
				'tablet_default'    => 3,
				'mobile_default'    => 1,
                'selectors' => [
                    '{{WRAPPER}} .shopengine-shopengine-filterable-product-list .filter-content-row' => 'grid-template-columns: repeat({{VALUE}}, 1fr)'
                ],
			]
        );

        $this->add_control(
            'product_order',
            [
                'label' => esc_html__('Order', 'shopengine'),
                'type' => Controls_Manager::SELECT,
                'default'   => esc_html('DESC', 'shopengine'),
                'options'   => [
                    'ASC'       => esc_html__('ASC', 'shopengine'),
                    'DESC'      => esc_html__('DESC', 'shopengine'),
                ],
            ]
        );

        $this->add_control(
            'product_orderby',
            [
                'label' => esc_html__('Order By', 'shopengine'),
                'type' => Controls_Manager::SELECT,
                'default'   => esc_html('date', 'shopengine'),
                'options'   => [
                    'ID'       => esc_html__('ID', 'shopengine'),
                    'title'     => esc_html__('Title', 'shopengine'),
                    'name'      => esc_html__('Name', 'shopengine'),
                    'date'      => esc_html__('Date', 'shopengine'),
                    'comment_count'      => esc_html__('Popular', 'shopengine'),
                ],
            ]
        );


		$repeater = new Repeater();

		$repeater->add_control(
            'filter_label',
            [
                'label' =>esc_html__( 'Filter Label', 'shopengine' ),
                'type' => Controls_Manager::TEXT,
            ]
		);

		$repeater->add_control(
			'product_list',
			[
				'label' =>esc_html__( 'Select Products', 'shopengine' ),
                'label_block' => true,
				'type' => ShopEngine_Controls_Manager::AJAXSELECT2,
				'options'   =>'ajaxselect2/product_list',
                'multiple' => true
			]
        );

        $this->add_control(
            'filter_content',
            [
                'label' => esc_html__('Filter Content', 'shopengine'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'after',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ filter_label }}}'
            ]
		);

        $this->end_controls_section();
        //  General control end


        /*
            ================================
            settings start
            ================================
        */

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'shopengine'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'shopengine_show_sale_flash',
            [
                'label'     => esc_html__( 'Flash Sale', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'default'   => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'display: block;',
                ],
            ]
        );

        $this->add_control(
            'shopengine_is_cats',
            [
                'label'     => esc_html__( 'Show Categories', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'return_value' => 'yes',
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'shopengine_is_details',
            [
                'label'     => esc_html__( 'Show Description', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'return_value' => 'yes',
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'shopengine_is_product_rating',
            [
                'label'     => esc_html__( 'Rating', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'return_value' => 'yes',
                'default'   => 'yes',
            ]
        );


        $this->add_control(
            'shopengine_show_regular_price',
            [
                'label'     => esc_html__( 'Regular Price', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'default'   => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .price del' => 'display: inline-block;',
                ],
            ]
        );

        $this->add_control(
            'shopengine_is_off_tag',
            [
                'label'     => esc_html__( 'OFF Tag Badge', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'default'   => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .price .shopengine-badge' => 'display: inline-block;',
                ],
            ]
        );

        $this->add_control(
            'shopengine_group_btns',
            [
                'label'     => esc_html__( 'Button Group', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'default'   => 'yes'
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'custom-order-section',
            [
                'label' => esc_html__('Custom Ordering', 'shopengine'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $default = [
			[
				'list_title' => esc_html__( 'Image', 'shopengine' ),
				'list_key' => 'image',
			],
			[
				'list_title' => esc_html__( 'Category', 'shopengine' ),
				'list_key' => 'category',
			],
			[
				'list_title' => esc_html__( 'Title', 'shopengine' ),
				'list_key' => 'title',
			],
			[
				'list_title' => esc_html__( 'Rating', 'shopengine' ),
				'list_key' => 'rating',
			],
			[
				'list_title' => esc_html__( 'Price', 'shopengine' ),
				'list_key' => 'price',
			],
			[
				'list_title' => esc_html__( 'Description', 'shopengine' ),
				'list_key' => 'description',
			],
			[
				'list_title' => esc_html__( 'Buttons', 'shopengine' ),
				'list_key' => 'buttons',
			],
		];
		
		$repeater = new Repeater();
		$this->add_control(
			'shopengine_custom_ordering_list',
			[
				'label' => esc_html__( 'Ordering List', 'shopengine' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => $default,
				'title_field' => '{{{ list_title }}}',
				'item_actions' => [
					'add'       => false,
					'duplicate' => false,
					'remove'    => false,
					'sort'      => true,
				]
			]
		);

        $this->end_controls_section();
        //settings end

        /*
            ===========================
            product filer nav start
            ===========================
        */
        $this->start_controls_section(
            'product_filter_nav_style_section',
            [
                'label' => esc_html__('Product Filter Nav', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'product_filter_nav_alignment',
            [
                'label'        => esc_html__('Alignment', 'shopengine'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'description' => esc_html__('Left', 'shopengine'),
                        'icon'        => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'description' => esc_html__('Center', 'shopengine'),
                        'icon'        => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'description' => esc_html__('Right', 'shopengine'),
                        'icon'        => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-nav' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_filter_nav_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .filter-nav a',
                'exclude'       => ['font_family', 'font_style', 'text_decoration'],
                'fields_options'    => [
					'typography'     => [
						'default' => 'custom',
					],
                    'font_weight'   => [
                        'default'   => '500',
                    ],
                    'font_size'     => [
                        'label'     => esc_html__('Font Size', 'shopengine'),
                        'default'   => [
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'     => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ]
                ],
            )
        );

		$this->start_controls_tabs(
			'product_filter_nav_tabs'
		);

		$this->start_controls_tab(
			'product_filter_nav_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

        $this->add_control(
            'product_filter_nav_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'product_filter_nav_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

        $this->add_control(
            'product_filter_nav_hover_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a:hover'   => 'color: {{VALUE}}',
                    '{{WRAPPER}} .filter-nav a.active'  => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'product_filter_nav_item_padding',
            [
                'label'			=> esc_html__( 'Item Padding', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '0',
                    'right' => '15',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .filter-nav li a' => 'margin: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}}; padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    '{{WRAPPER}} .filter-nav li:first-child a' => 'padding-left: 0; margin-left:0',
                    '{{WRAPPER}} .filter-nav li:last-child a' => 'padding-right: 0;margin-right:0',
                    '.rtl {{WRAPPER}} .filter-nav li a' => 'margin: 0 {{LEFT}}{{UNIT}} 0 {{RIGHT}}{{UNIT}}; padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
                'separator' => 'before',
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'product_filter_nav_item_indicator_border',
				'label' => esc_html__('Bottom Border', 'shopengine'),
				'fields_options' => [
					'border'     => [
						'default' => 'solid',
                        'label' => esc_html__('Item Indicator Bottom', 'shopengine'),
					],
					'width'     => [
                        'label' => esc_html__('Item Indicator Border', 'shopengine'),
                        'allowed_dimensions'    =>  ['bottom'],
						'default'       => [
							'top'       => '0',
							'right'     => '0',
							'bottom'    => '2',
							'left'      => '0',
							'isLinked'  => false,
						],
					],
					'color'     => [
                        'label' => esc_html__('Item Indicator Color', 'shopengine'),
						'default' => '#F03D3F',
                        'alpha'   => false
					]
				],
				'selector' => '{{WRAPPER}} .filter-nav a.active::before, {{WRAPPER}} .filter-nav a:hover::before',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_filter_nav_seperator',
			[
				'label' => esc_html__( 'Nav Seperator', 'shopengine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'show_nav_seperator',
            [
                'label'         => esc_html__('Show Nav Seperator', 'shopengine'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'shopengine'),
                'label_off'     => esc_html__('No', 'shopengine'),
                'return_value'  => 'yes',
                'default'       => (isset( $default['badge']) ? esc_attr($default['badge']) : ''),
                'selectors'	    => [
                    '{{WRAPPER}} .filter-nav li:not(:last-child)::before' => 'content: ""; position: absolute; top: 0; right: 0;'
                ],
            ]
        );

		$this->add_control(
			'nav_seperator_height',
			[
				'label' => esc_html__('Nav Seperator Height (px)', 'shopengine'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
                'range' => [
					'px' => [
						'min'   => 0,
						'max' => 100,
						'step'  => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-nav li:not(:last-child)::before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_nav_seperator' => 'yes',
				],
			]
		);

		$this->add_control(
			'nav_seperator_position_top',
			[
				'label' => esc_html__('Nav Seperator Position Top (px)', 'shopengine'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
                'range' => [
					'px' => [
						'min'   => 0,
						'max' => 200,
						'step'  => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-nav li:not(:last-child)::before' => 'top: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'show_nav_seperator' => 'yes',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_seperator_border',
                'label' => esc_html__('Border', 'shopengine'),
                'selector' => '{{WRAPPER}} .filter-nav li:not(:last-child)::before',
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                    ],
                    'width'     => [
                        'allowed_dimensions'    =>  ['right'],
                        'default'       => [
                            'top'       => '0',
                            'right'     => '2',
                            'bottom'    => '0',
                            'left'      => '0',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2',
                        'alpha'   => false
                    ]
                ],
				'condition' => [
					'show_nav_seperator' => 'yes',
				],
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'nav_active_item_border_around_heading',
			[
				'label' => esc_html__( 'Active Item Border', 'shopengine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_nav_seperator!' => 'yes',
				],
			]
		);

        $this->add_control(
            'show_active_nav_item_border_around',
            [
                'label'         => esc_html__('Show Active Item Border', 'shopengine'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'shopengine'),
                'label_off'     => esc_html__('No', 'shopengine'),
                'return_value'  => 'yes',
                'default'       => (isset( $default['badge']) ? esc_attr($default['badge']) : ''),
				'condition' => [
					'show_nav_seperator!' => 'yes',
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_item_border_around',
                'label' => esc_html__('Nav Item Border', 'shopengine'),
                'fields_options' => [
                    'border'     => [
                        'label' => esc_html__('Nav Item Border', 'shopengine'),
                        'default' => 'solid',
                        'selectors' 	=> [
                            '{{WRAPPER}} .filter-nav li a:not(.active, :hover)' => 'border-style: {{VALUE}}',
                            '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-style: {{VALUE}}',
                        ],
                    ],
                    'width'     => [
                        'label' => esc_html__('Nav Item Border Width', 'shopengine'),
                        'default'       => [
                            'top'       => '2',
                            'right'     => '2',
                            'bottom'    => '2',
                            'left'      => '2',
                            'isLinked'  => true,
                        ],
                        'selectors' 	=> [
                            '{{WRAPPER}} .filter-nav li a:not(.active, :hover)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Nav Item Border Color', 'shopengine'),
                        'default' => '#E60000',
                        'selectors' 	=> [
                            '{{WRAPPER}} .filter-nav li a:not(.active, :hover)' => 'border-color: transparent',
                            '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                ],
				'condition' => [
					'show_nav_seperator!' => 'yes',
					'show_active_nav_item_border_around' => 'yes',
				],
            ]
        );

		$this->add_control(
			'nav_item_border_around_radius',
			[
				'label' => esc_html__('Nav Item Border Radius (px)', 'shopengine'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
                'range' => [
					'px' => [
						'min'   => 0,
						'max' => 200,
						'step'  => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'show_nav_seperator!' => 'yes',
					'show_active_nav_item_border_around' => 'yes',
				],
			]
		);

		$this->add_control(
			'product_filter_nav_wrap',
			[
				'label' => esc_html__( 'Nav Wrap', 'shopengine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


        $this->add_responsive_control(
            'product_filter_nav_wrap_margin',
            [
                'label'			=> esc_html__( 'Nav Wrap Margin', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .filter-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'separator' => 'after',
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'product_filter_nav_wrap_border',
				'label' => esc_html__('Border', 'shopengine'),
				'fields_options' => [
					'border'     => [
                        'label' => esc_html__('Nav Wrap Border', 'shopengine'),
					],
					'width'     => [
                        'label' => esc_html__('Nav Wrap Border Width', 'shopengine'),
					],
					'color'     => [
                        'label' => esc_html__('Nav Wrap Border Color', 'shopengine'),
                        'alpha' => false,
                        'responsive' => false,
					]
				],
				'selector' => '{{WRAPPER}} .filter-nav',
			]
		);

        $this->end_controls_section();

        // product filter nav end

         /*
            ----------------------------
            product wrap style
            ----------------------------
        */

        $this->start_controls_section(
            'product_wrap_style_section',
            [
                'label' => esc_html__('Product Wrap', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'product_content_align',
            [
                'label'        => esc_html__('Content Alignment', 'shopengine'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'description' => esc_html__('Left', 'shopengine'),
                        'icon'        => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'description' => esc_html__('Center', 'shopengine'),
                        'icon'        => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'description' => esc_html__('Right', 'shopengine'),
                        'icon'        => 'eicon-text-align-right',
                    ],
                ],

                'selectors_dictionary' => [
					'left'   => 'text-align: left; -webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;',
					'center' => 'text-align: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;',
					'right'  => 'text-align: right; -webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;',
				],

                'selectors' => [
                    '{{WRAPPER}} .shopengine-single-product-item :is(
                        .product-category ul, 
                        .product-title, 
                        .product-rating, 
                        .price )' => '{{VALUE}}',
                    '{{WRAPPER}} .shopengine-single-product-item .add-to-cart-bt' => '{{VALUE}}',
                    '.rtl {{WRAPPER}}.elementor-align-left .shopengine-single-product-item :is( .product-category ul, .product-title, .product-rating, .price )' => 'text-align:right;',  
                    '.rtl {{WRAPPER}}.elementor-align-right .shopengine-single-product-item :is( .product-category ul, .product-title, .product-rating, .price )' => 'text-align:left;',
                ],
                'prefix_class'         => 'elementor%s-align-',
            ]
        );

        $this->add_control(
            'product_wrap_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .shopengine-single-product-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_wrap_gap',
            [
                'label'         => esc_html__( 'Gap (px)', 'shopengine' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .shopengine-shopengine-filterable-product-list .filter-content-row' => 'grid-gap: {{SIZE}}px;',
                ],
                'separator'     => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_wrap_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '15',
                    'right' => '15',
                    'bottom' => '15',
                    'left' => '15',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .shopengine-single-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'product_wrap_border',
                'label'     => esc_html__('Border', 'shopengine'),
                'selector'  => '{{WRAPPER}} .shopengine-single-product-item',
                'separator' => 'before',
                'fields_options' => [
                    'color'     => [
                        'alpha' => false
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // product wrap style end


        /*
            ===============================
            product image start
            ===============================
        */

        $this->start_controls_section(
            'product_image_style',
            [
                'label' => esc_html__('Product Image', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_image_bg',
            [
                'label'     => esc_html__('Image Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-thumb' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_image_margin',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        // product image end

        /*
            ============================
            product category start
            ============================
        */
        $this->start_controls_section(
            'product_category_style_section',
            [
                'label' => esc_html__('Product Category', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'shopengine_is_cats'   => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_category_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .product-category ul li a',
                'exclude'  => ['font_family', 'font_style', 'text_decoration', 'letter_spacing'],
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '13',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'default'   => [
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'label'      => esc_html__('Line Height (px)', 'shopengine'),
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                         'responsive' => false
                    ],
                ],
                'separator' => 'after',
            )
        );

        $this->add_control(
            'product_category_color',
            [
                'label' => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#858585',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-category ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_category_hover_color',
            [
                'label' => esc_html__('Hover Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F03D3F',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-category ul li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_category_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
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
                    '{{WRAPPER}} .product-category' => 'line-height: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // product category end

        /*
            ============================
            product title start
            ============================
        */

        $this->start_controls_section(
            'product_title_style_section',
            [
                'label' => esc_html__('Product Title', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_title_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .product-title',
                'exclude'  => ['font_family', 'font_style', 'text_decoration'],
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '15',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ],
                ],
            )
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#535353',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_title_color_hover',
            [
                'label' => esc_html__('Hover Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0A0A0A',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_title_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '5',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-title' => 'margin: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // product title end

        /*
            ===========================
            product rating start
            ===========================
        */
        $this->start_controls_section(
            'product_rating_style_section',
            [
                'label' => esc_html__('Product Rating', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'shopengine_is_product_rating'   => 'yes'
                ]
            ]
        );

        $this->add_control(
            'product_rating_star_size',
            [
                'label' => esc_html__('Rating Star Size', 'shopengine'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 100,
                        'step'  => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_rating_star_color',
            [
                'label'     => esc_html__('Star Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fec42d',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-rating .star-rating' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'product_rating_empty_star_color',
            [
                'label'     => esc_html__('Empty Star Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fec42d',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-rating .star-rating::before' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'product_rating_count_color',
            [
                'label'     => esc_html__('Count Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999999',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .rating-count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_rating_count_typography',
                'label'    => esc_html__('Count Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .rating-count',
                'exclude'  => ['font_family', 'font_style', 'text_decoration', 'text_transform', 'line_height', 'letter_spacing'],
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '12',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '12',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ]
                ],
            )
        );

        $this->add_responsive_control(
            'product_rating_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default' => [
                    'top' => '0',
                    'right'     => '0',
                    'bottom'    => '10',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-rating' => 'line-height: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // product rating end

        /*
            ----------------------------
            Off tag
            ----------------------------
        */

        $this->start_controls_section(
            'shopengine_off_tag',
            [
                'label' => esc_html__('OFF Tag', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'shopengine_is_off_tag'  => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_price_discount_badge_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .product-price .shopengine-discount-badge',
                'exclude'  => ['font_family', 'font_style', 'text_decoration'],
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '10',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ],
                ],
            )
        );

        $this->add_control(
            'product_price_discount_badge_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .product-price .shopengine-discount-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_price_discount_badge_bg_color',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#F54F29',
                'selectors' => [
                    '{{WRAPPER}} .product-price .shopengine-discount-badge' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'product_price_discount_badge_border',
                'label'         => esc_html__('Border', 'shopengine'),
                'selector'      => '{{WRAPPER}} .product-price .shopengine-discount-badge',
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'product_price_discount_badge_border_radius',
            [
                'label'      => esc_html__('Border Radius (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'      => '2',
                    'right'    => '2',
                    'bottom'   => '2',
                    'left'     => '2',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .product-price .shopengine-discount-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_price_discount_badge_padding',
            [
                'label'			=> esc_html__( 'Badge Padding (px)', 'shopengine' ),
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
                    '{{WRAPPER}} .product-price .shopengine-discount-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_price_discount_badge_margin',
            [
                'label'			=> esc_html__( 'Badge Margin (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-price .shopengine-discount-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  => 'before',
            ]
        );

        $this->end_controls_section();

        // end off tag


         /*
            ==============================
            Sale Fash
            ==============================
         */
        $this->start_controls_section(
            'shopengine_section_sale_flash',
            [
                'label' =>  esc_html__('Flash Sale', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'shopengine_show_sale_flash' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'shopengine_sale_flash_color',
            [
                'label' => esc_html__( 'Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shopengine_sale_flash_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#4285F4',
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'shopengine_sale_flash_typography',
                'label'     => esc_html__('Typography', 'shopengine'),
                'selector'  => '{{WRAPPER}} .product-tag-sale-badge',
                'exclude'   => ['font_family', 'font_style', 'text_decoration'],
                'fields_options'    => [
                    'typography'    => [
                        'default'   => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '500',
                    ],
                    'font_size'     => [
                        'label'     => esc_html__('Font Size (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '14',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'],
                        'responsive' => false,
                    ],
                    'text_transform'    => [
                        'default'   => 'capitalize',
                    ],
                    'line_height'   => [
                        'label'     => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ],
                ],
            )
        );


        $this->add_control(
            'shopengine_use_fixed_size',
            [
                'label'     => esc_html__( 'Use padding', 'shopengine' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'shopengine' ),
                'label_off' => esc_html__( 'Hide', 'shopengine' ),
                'return_value' => 'yes',
                'default'   => '',
            ]
        );

        $this->add_control(
            'shopengine_sale_flash_radius',
            [
                'label'			=> esc_html__( 'Border Radius', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ '%', 'px' ],
                'default'   => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => '%',
                    'isLinked' => true,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
		);

        $this->add_control(
            'shopengine_sale_flash_paddng',
            [
                'label'			=> esc_html__( 'Padding', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px' ],
                'condition'     => [ 'shopengine_use_fixed_size' => 'yes' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'line-height:initial; min-height:auto; min-width:auto; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
		);

        $this->add_control(
            'shopengine_sale_flash_sizee',
            [
                'label' => esc_html__( 'Size', 'shopengine' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'condition'     => [ 'shopengine_use_fixed_size' => '' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'min-width:auto; min-height:auto;padding:0; text-align:center; line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        // Position
        $this->add_control(
            'shopengine_sale_flash_pos',
            [
                'label'         => esc_html__( 'Position', 'shopengine' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'shopengine' ),
                        'icon'  => 'eicon-chevron-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'shopengine' ),
                        'icon'  => 'eicon-chevron-right',
                    ],
                ],
                'default'       => 'left',
                'toggle'        => false,
                'separator'     => 'before',
            ]
        );

        $this->add_responsive_control(
            'shopengine_sale_flash_position_horizontial',
            [
                'label' => esc_html__( 'Horizontal', 'shopengine' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge' => '{{shopengine_sale_flash_pos.VALUE}}: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shopengine_sale_flash_position_vertical',
            [
                'label' => esc_html__( 'Vertical', 'shopengine' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge' => 'top:  {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // end ./ Flash Sale



        /*
            ===========================
            product price
            ===========================
        */

        $this->start_controls_section(
            'product_price_style_section',
            [
                'label' => esc_html__('Product Price', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_price_price_color',
            [
                'label'     => esc_html__('Regular Price Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .product-price .price span.amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_price_sale_price_color',
            [
                'label' => esc_html__('Sale Price Color', 'shopengine'),
                'type' => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#999999',
                'selectors' => [
                    '{{WRAPPER}} .product-price .price del span.amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_price_typography',
                'label'    => esc_html__('Regular Price Typography', 'shopengine'),
                'exclude'  => ['font_family', 'font_style', 'text_decoration', 'line_height', 'letter_spacing', 'text_transform'],
                'selector' => '{{WRAPPER}} .product-price .price',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ],
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_price_sale_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'exclude'  => ['font_family', 'font_style', 'text_decoration'],
                'description'   => esc_html__('Typography for sale price and discount badge', 'shopengine'),
                'selector' => '{{WRAPPER}} .shopengine-single-product-item .product-price :is(.onsale-off, .price del)',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                        'label'   => esc_html__('Typography Sale and Discount', 'shopengine'),
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
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '24',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing'  => [
                        'responsive' => false
                    ]
                ],
            )
        );

        $this->add_responsive_control(
            'product_price_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_price_space_between',
            [
                'label' => esc_html__('Space In-between Prices', 'shopengine'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 500,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max' => 100,
                        'step'  => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-price .price ins, .product-price .price del' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '.rtl {{WRAPPER}} .product-price .price ins, .rtl {{WRAPPER}} .product-price .price del' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right:0px',
                ],

            ]
        );

        $this->end_controls_section();
        // product price

        /*
            ===========================
            product description start
            ==========================
        */

        $this->start_controls_section(
            'product_description_style_section',
            [
                'label' => esc_html__('Product Description', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_description_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'exclude'  => ['font_family', 'font_style', 'text_decoration'],
                'selector' => '{{WRAPPER}} .prodcut-description',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '14',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'responsive' => false
                    ]
                ],
            )
        );

        $this->add_control(
            'product_description_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .prodcut-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_description_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '15',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .prodcut-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_description_border',
                'label' => esc_html__('Border', 'shopengine'),
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '1',
                            'right'     => '0',
                            'bottom'    => '0',
                            'left'      => '0',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2',
                        'alpha'     => false,
                    ]
                ],
                'selector' => '{{WRAPPER}} .prodcut-description',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        // product description end

         /*
            ----------------------------
            Button group
            ----------------------------
        */


        $this->start_controls_section(
            'shopengine_section_button_group',
            [
                'label' => esc_html__( 'Button group', 'shopengine' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'shopengine_group_btns' => 'yes'
                ]
            ]
		);

        $this->add_control(
			'shopengine_button_group_btn_clr',
			[
				'label' => esc_html__( 'Color', 'shopengine' ),
				'type'  => Controls_Manager::COLOR,
                'alpha'     => false,
                'default' => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-filterable-product-wrap .filter-content .shopengine-single-product-item .add-to-cart-bt .se-btn' => 'transition: none !important; color: {{VALUE}} !important;'
				],
			]
		);

        $this->add_control(
			'shopengine_button_group_btn_hover_active_clr',
			[
				'label' => esc_html__( 'Hover and Active Color', 'shopengine' ),
				'type'  => Controls_Manager::COLOR,
                'alpha'     => false,
                'default' => '#F03D3F',
				'selectors' => [
					'{{WRAPPER}} .shopengine-filterable-product-wrap .filter-content .shopengine-single-product-item .add-to-cart-bt .se-btn:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .shopengine-filterable-product-wrap .filter-content .shopengine-single-product-item .add-to-cart-bt .se-btn.active' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .shopengine-filterable-product-wrap .filter-content .shopengine-single-product-item .add-to-cart-bt .se-btn:hover i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .shopengine-filterable-product-wrap .filter-content .shopengine-single-product-item .add-to-cart-bt .se-btn.active i' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'shopengine_button_group_btn_icon_size',
			[
				'label' => esc_html__( 'Icon size', 'shopengine' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-filterable-product-wrap .filter-content .shopengine-single-product-item .add-to-cart-bt .se-btn' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        /*
            ============================
            add to cart start
            ============================
        */

        $this->start_controls_section(
            'product_add_to_cart_button_style_section',
            [
                'label' => esc_html__('Add to Cart', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'shopengine_group_btns' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_add_to_cart_button_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'exclude'  => ['font_family', 'font_style', 'text_decoration'],
                'selector' => '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '500',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '13',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'shopengine'),
                        'size_units' => ['px'],
                        'responsive' => false
                    ],
                    'text_transform'    => [
                        'default'   => '',
                    ],
                    'line_height'   => [
                        'label'    => esc_html__('Line Height (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'], // enable only px
                        'responsive' => false
                    ],
                    'letter_spacing' => [
                        'default' => [
                            'size' => '0.4',
                        ],
                        'responsive' => false
                    ],
                ],
            )
        );

        $this->start_controls_tabs(
            'product_add_to_cart_button_tabs'
        );

        $this->start_controls_tab(
            'product_add_to_cart_button_normal_tab',
            [
                'label' => esc_html__('Normal', 'shopengine'),
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button'   => 'border:0 !important; color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_bg_color',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#3E3E3E',
                'selectors' => [
                    '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_add_to_cart_button_hover_tab',
            [
                'label' => esc_html__('Hover', 'shopengine'),
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_hover_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button:hover'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_hover_bg_color',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#F54F29',
                'selectors' => [
                    '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button:hover'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'product_add_to_cart_button_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'shopengine' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '12',
                    'right' => '14',
                    'bottom' => '12',
                    'left' => '14',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'product_add_to_cart_button_border',
                'label'          => esc_html__('Border', 'shopengine'),
                'selector'       => '{{WRAPPER}} .filter-content .filtered-product-list .shopengine-single-product-item .add-to-cart-bt .button',
                'separator'      => 'before',
                'fields_options' => [
                    'color'      => [
                        'alpha'      => false,
                    ],
                ],
            ]
        );

        $this->end_controls_section();
        // add to cart end

        //global font family option
        $this->start_controls_section(
			'shopengine_filterable_product_list_typography',
			array(
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_filterable_product_list_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .filter-nav a,
                    {{WRAPPER}} .product-category ul li a,
                    {{WRAPPER}} .product-title,
                    {{WRAPPER}} .rating-count,
                    {{WRAPPER}} .product-tag-sale-badge,
                    {{WRAPPER}} .product-price .price,
                    {{WRAPPER}} .product-price .onsale-off, .shopengine-single-product-item .product-price .price del,
                    {{WRAPPER}} .prodcut-description,
                    {{WRAPPER}} .button' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

    }


    protected function screen( ) {
        $settings = $this->get_settings_for_display();
        $is_content = [
            'shopengine_is_cats' => ($settings['shopengine_is_cats'] === 'yes') ? 'yes' : 'no',
            'shopengine_is_details' => ($settings['shopengine_is_details'] === 'yes') ? 'yes' : 'no',
            'shopengine_is_product_rating' => ($settings['shopengine_is_product_rating'] === 'yes') ? 'yes' : 'no',
            'shopengine_group_btns' => ($settings['shopengine_group_btns'] === 'yes') ? 'yes' : 'no',
        ];

        ?>
            <div class="shopengine-<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($is_content); ?>'>
                <?php
                    $tpl = Products::instance()->get_widget_template($this->get_name());
                    include $tpl;
                ?>
            </div>
        <?php
    }
}
