<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Review_Order extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Checkout_Review_Order_Config();
	}

	protected function register_controls() {

		/*
			---------------------------------
		  	Header Section
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_table_heading_section',
			[
				'label' => esc_html__('Table Header', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'shopengine_orders_header_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table thead th' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_orders_header_border_color',
			[
				'label'     => esc_html__('Border Bottom Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#DCDCDC',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table thead tr' => 'box-shadow: 0px 1px {{VALUE}}, 0 3px #ffffff;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_orders_header_text_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-checkout-review-order #order_review .woocommerce-checkout-review-order-table thead th',
				'exclude'        => ['font_family', 'text_decoration', 'font_style', 'line_height', 'letter_spacing'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '55',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false
					],
					'letter_spacing' => [
						'responsive' => false
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_table_header_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '15',
					'bottom'   => '17',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table thead tr' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'.rtl {{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table thead tr' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_table_header_spacing',
			[
				'label'      => esc_html__('Margin Bottom (px)', 'shopengine'),
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
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table thead tr' => 'margin-bottom: {{SIZE}}{{UNIT}}'
				],
			]
		);

		$this->end_controls_section(); // end ./ header section

		/*
			---------------------------------
		  	body section  style
			------------------------------------
		 */


		$this->start_controls_section(
			'shopengine_table_body_section',
			[
				'label' => esc_html__('Table Body', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_table_body_text_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody td' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_orders_body_background',
			[
				'label'     => esc_html__('Row Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table > tbody > tr' => 'background-color: {{VALUE}} !important',
				],
			]
		);
		

		$this->add_control(
			'shopengine_table_body_price_color',
			[
				'label'     => esc_html__('Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody td .amount' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'shopengine_orders_items_border_color',
			[
				'label'     => esc_html__('Items Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#DCDCDC',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody tr' => 'box-shadow: 0px 1px {{VALUE}}, 0 3px #ffffff;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_orders_body_price_typography',
				'label'          => esc_html__('Price Font Weight', 'shopengine'),
				'exclude'        => ['font_family', 'font_size', 'line_height', 'letter_spacing', 'text_decoration', 'text_transform', 'font_style'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default'   => '500',
						'selectors' => [
							'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody td .woocommerce-Price-amount' => 'font-weight: {{VALUE}} !important',
						],
					],
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_orders_body_text_typography',
				'label'    => esc_html__('Text Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody :is(td, label, .amount, strong, bdi)',
				'exclude'  => ['font_family', 'font_weight', 'font_style', 'letter_spacing', 'text_decoration'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody :is(td, label, .amount, strong, bdi)' => 'font-size: {{SIZE}}{{UNIT}} !important',
						],
					],
					'line_height' => [
						'label'          => esc_html__('Line-Height (px)', 'shopengine'),
						'default'        => [
							'size' => '22',
							'unit' => 'px',
						],
						'size_units'     => ['px'],
						'responsive' => false
					],
				],
			]
		);
		


		$this->add_responsive_control(
			'shopengine_table_body_data_padding',
			[
				'label'      => esc_html__('Row Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => 10,
					'right'    => 20,
					'bottom'   => 10,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table:not(.shipping__table--multiple) > tbody > tr' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_table_body_spacing',
			[
				'label'      => esc_html__('Row Space In-between (px)', 'shopengine'),
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
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tbody tr:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);


		$this->add_control(
			'shopengine_table_body_image_size',
			[
				'label'      => esc_html__('Image Size (px)', 'shopengine'),
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
					'size' => 60,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-review-order .shopengine-order-review-product img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();  // end ./ body section style

		/*
			---------------------------------
		  	Footer section  style
			------------------------------------
		 */


		$this->start_controls_section(
			'shopengine_table_footer_section',
			[
				'label' => esc_html__('Table Footer', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'shopengine_footer_text_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tfoot :is(th, td, label)' => 'color: {{VALUE}} !important'
				],
			]
		);

		$this->add_control(
			'shopengine_footer_price_color',
			[
				'label'     => esc_html__('Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FF3F00',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tfoot :is(th, td) .amount' => 'color: {{VALUE}} !important'
				],
			]
		);

		$this->add_control(
			'shopengine_orders_footer_border_color',
			[
				'label'     => esc_html__('Row Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#DCDCDC',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tfoot tr:not(:last-child)' => 'box-shadow: 0px 1px {{VALUE}}, 0 3px #ffffff;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_footer_color_typography',
				'label'    => esc_html__('Text Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tfoot th, 
				{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tfoot td :is(label, .amount)',
				'exclude'  => ['font_family', 'font_style','line_height', 'letter_spacing', 'text_decoration'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '700',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table tfoot :is(label, th, td, .amount)' => 'font-size: {{SIZE}}{{UNIT}} !important',
						],
					],
					'line_height' => [
						'label'          => esc_html__('Line-Height (px)', 'shopengine'),
						'default'        => [
							'size' => '22',
							'unit' => 'px',
						],
		
						'size_units'     => ['px'],
						'responsive' => false
					],
				],
			]
		);

		

		$this->add_responsive_control(
			'shopengine_table_footer_data_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '15',
					'right'    => '15',
					'bottom'   => '15',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table:not(.shipping__table--multiple) > tfoot > tr' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'.rtl {{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table:not(.shipping__table--multiple) > tfoot > tr' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;',
				],
			]
		);


		$this->end_controls_section();

		/*
			---------------------------
			global font family
			---------------------------
		*/
		$this->start_controls_section(
			'shopengine_checkout_review_order_typography',
			array(
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_checkout_review_order_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-checkout-review-order .woocommerce-checkout-review-order-table :is(td, th, a, label, span, *)' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function screen() {

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
