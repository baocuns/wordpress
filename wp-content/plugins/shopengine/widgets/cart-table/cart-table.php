<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Cart_Table extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Cart_Table_Config();
	}


	protected function register_controls() {

        /*
        * Setting Tab - Content
        */
		$this->start_controls_section(
			'shopengine_section_cart_table_general',
			[
				'label'     => esc_html__('General', 'shopengine'),
				'type'      => Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer__buttons',
			[
				'label'     => esc_html__('Buttons', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_continue_shopping',
			[
				'label'        => esc_html__('Hide Continue Shopping Button?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'none',
				'default'      => 'inline-block',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer  .return-to-shop' => 'display: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'show_clear_all',
			[
				'label'        => esc_html__('Hide Clear All Button?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'none',
				'default'      => 'inline-block',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer button[name=empty_cart]' => 'display: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shopengine_section_cart_table_content',
			[
				'label'     => esc_html__('Content', 'shopengine'),
				'type'      => Controls_Manager::TAB_SETTINGS,
			]
		);
		
		$this->add_control(
			'shopengine_cart_table_title',
			[
				'label'     => esc_html__('Title', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Product Name', 'shopengine')
			]
		);

		$this->add_control(
			'shopengine_cart_table_price',
			[
				'label'     => esc_html__('Price', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Price', 'shopengine')
			]
		);

		$this->add_control(
			'shopengine_cart_table_quantity',
			[
				'label'     => esc_html__('Quantity', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Quantity', 'shopengine')
			]
		);

		$this->add_control(
			'shopengine_cart_table_subtotal',
			[
				'label'     => esc_html__('Subtotal', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Subtotal', 'shopengine')
			]
		);
		
		$this->add_control(
			'shopengine_cart_continue_shopping_btn',
			[
				'label'     => esc_html__('Continue Shopping', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Continue Shopping', 'shopengine')
			]
		);

		$this->add_control(
			'shopengine_cart_table_update',
			[
				'label'     => esc_html__('Update Cart', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Update Cart', 'shopengine')
			]
		);

		$this->add_control(
			'shopengine_cart_table_clear_all',
			[
				'label'     => esc_html__('Clear All', 'shopengine'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Clear All', 'shopengine')
			]
		);

		$this->end_controls_section();

        /*
			==============================
        	Style Tab - Cart Table Header
			=============================
        */
        $this->start_controls_section(
            'shopengine_section__cart_table_head',
            [
                'label' => esc_html__('Table Header', 'shopengine'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'shopengine_cart_table_head__bg_color',
            [
                'label' 	=> esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
                'default'   => '#F2F2F2',
				'alpha'		=> false,
                'selectors' => [
                    '{{WRAPPER}} .shopengine-cart-table .shopengine-table__head' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shopengine_cart_table_head__color',
            [
                'label' 	=> esc_html__( 'Text Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
                'default'   => '#3a3a3a',
				'alpha'		=> false,
                'selectors' => [
                    '{{WRAPPER}} .shopengine-cart-table .shopengine-table__head div' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'shopengine_cart_table_head_typography',
                'label'    => esc_html__('Typography', 'shopengine'),
                'name'		=> 'shopengine_cart_table_head_typography',
                'label'		=> esc_html__('Typography', 'shopengine'),
                'selector'	=> '{{WRAPPER}} .shopengine-cart-table .shopengine-table__head div',
				'exclude'	=> ['font_style', 'text_decoration', 'font_family'],
                'fields_options'    => [
                    'typography'    => [
                        'default'   => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '600',
                    ],
                    'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
                        'default'   => [
                            'size'  => '16',
                            'unit'  => 'px'
                        ],
						'size_units' => ['px']
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
					'line_height'    => [
						'label'      => esc_html__('Line-Height (px)', 'shopengine'),
						'default'    => [
							'size' => '19',
							'unit' => 'px'
						],
						'size_units' => ['px']
					],
					'letter_spacing' => [
						'default' => [
							'size' => '0',
						]
					],
				],
			)
		);

		$this->add_responsive_control(
			'shopengine_cart_table_head__padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '12',
					'right'    => '40',
					'bottom'   => '12',
					'left'     => '40',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section(); // end ./ Style Tab - Cart Table Header

		/*
			===============================
		 	Style Tab - Cart Table Body
			===============================
		 */

		$this->start_controls_section(
			'shopengine_section__cart_table_content',
			[
				'label' => esc_html__('Table Body', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_cart_table_single_cart_item_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#ffffff',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body' => 'background: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'shopengine_cart_table_content__text_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#979797',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body :is(.shopengine-table__body-item--td, div, a, span)' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F2F2F2',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body' => 'border-style: solid; border-width: 0 1px 1px 1px; border-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_content__text_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#979797',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .shopengine-table__body-item--td a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_content__price_color',
			[
				'label'     => esc_html__('Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#222222',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .shopengine-table__body-item--td .amount :is(span, bdi)'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-cart-table table tbody .product-subtotal' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_cart_table_content_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .shopengine-table__body-item--td :is(a, .amount, bdi)',
				'exclude'		=> ['font_family', 'text_decoration', 'font_style', 'letter_spacing'],
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
							'size' => '14',
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
						'size_units' => ['px']
					],
					'letter_spacing' => [
						'default' => [
							'size' => '0',
						]
					],
				],
			)
		);

		$this->add_responsive_control(
			'shopengine_cart_table_content_padding',
			[
				'label'           => esc_html__('Content Padding (px)', 'shopengine'),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => ['px'],
				'desktop_default' => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '30',
					'left'     => '40',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'tablet_default'  => [
					'top'      => '20',
					'right'    => '30',
					'bottom'   => '20',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'       => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .shopengine-cart-table .shopengine-table__body' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],

			]
		);


		$this->add_control(
			'shopengine_cart_table_cell_gap',
			[
				'label'      => esc_html__('Row Gap', 'shopengine'),
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
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section(); // end ./ Style Tab - Cart Table Body

		/*
			===============================
		 	Style Tab - produt image
			===============================
		 */

		$this->start_controls_section(
			'shopengine_ct_product_image',
			[
				'label' => esc_html__('Product Image', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_ct_product_image_border_clr',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F2F2F2',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .product-thumbnail img'    => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_ct_product_image_width',
			[
				'label'      => esc_html__('Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .product-thumbnail img' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // end ./ Style Tab - produt image

		/*
			===============================
		 	Style Tab - Quantity
			===============================
		 */

		$this->start_controls_section(
			'shopengine_ct_quantity_section',
			[
				'label' => esc_html__('Quantity', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_cart_table_qty_btn_text_clr',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .shopengine-cart-quantity :is(.minus-button, .plus-button, .quantity, input)' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_qty_btn_hover_text_clr',
			[
				'label'     => esc_html__('Hover Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ACA3A3',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .shopengine-cart-quantity :is(.minus-button, .plus-button):hover' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_qty_btn_border_clr',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F2F2F2',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__body .shopengine-cart-quantity :is(.minus-button, .plus-button, .quantity)' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section(); // end ./ Style Tab - Quantity

		/*
		 * Style Tab - Cart Table Footer
		 */

		$this->start_controls_section(
			'shopengine_cart_table_footer_section',
			[
				'label' => esc_html__('Table Footer', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_cart_table_footer_padding',
			[
				'label'           => esc_html__('Padding (px)', 'shopengine'),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => ['px'],
				'desktop_default' => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'       => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer_btn_styles',
			[
				'label'     => esc_html__('Button Styles', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'          => 'shopengine_cart_table_footer_btn_typography',
				'label'         => esc_html__('Typography', 'shopengine'),
				'selector'      => '{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer .shopengine-footer-button',
				'exclude'		=> ['font_family', 'letter_spacing', 'line_height', 'text_decoration', 'font_style'], 
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
							'size' => '16',
							'unit' => 'px'
						],
						'size_units' => ['px']
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
				
				],
			)
		);

		

		$this->start_controls_tabs('shopengine_cart_table_footer_button_style__tabs');

		$this->start_controls_tab('shopengine_cart_table_footer_button_tab__normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer_btn_normal_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#979797',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer :is(.shopengine-footer-button, a, i)'   => 'color: {{VALUE}} !important;'
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer_btn_normal_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f1f1f1',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer .shopengine-footer-button' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('shopengine_cart_table_footer_button_tab__hover',
				[
					'label' => esc_html__('Hover', 'shopengine'),
				]
		);

		$this->add_control(
			'shopengine_cart_table_footer_btn_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer :is(.shopengine-footer-button, a):hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer .shopengine-footer-button:hover :is(a, i, span)' => 'color: {{VALUE}} !important;'
				]
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer_btn_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer .shopengine-footer-button:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_cart_table_footer_btn_hover_border_color',
			[
				'label'      => esc_html__('Button Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '13',
					'right'    => '22',
					'bottom'   => '15',
					'left'     => '22',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer .shopengine-footer-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'shopengine_cart_table_footer_btn_border_radius',
			[
				'label'     => esc_html__('Border Radius (px)', 'shopengine'),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'   => [
					'top'      => '4',
					'right'    => '4',
					'bottom'   => '4',
					'left'     => '4',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-table .shopengine-table__footer .shopengine-footer-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_responsive_control(
			'shopengine_cart_table_footer_btn_padding',
			[
				'label'      => esc_html__('Button Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '15',
					'right'    => '20',
					'bottom'   => '15',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-table table .shopengine-footer-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->end_controls_section();

		/*---------------------------
		global font family
		-----------------------------*/
		$this->start_controls_section(
			'shopengine_cart_table_typography',
			array(
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_cart_table_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-cart-table :is(.shopengine-table__body, .shopengine-table__head, .shopengine-table__footer) :is(div, span, a, button, bdi)' => 'font-family: {{VALUE}}',
				],
				'separator'  => 'before'
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Global Font
		 */
		$this->start_controls_section(
			'shopengine_cart_table_global_font_section',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_cart_table_global_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'selectors'   => [
					'{{WRAPPER}} .shopengine-cart-table table :is(th, tr, td, button, input)' => 'font-family: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // end ./ global font family
	}


	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
