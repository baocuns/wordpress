<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Shipping_Methods extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Checkout_Shipping_Methods_Config();
	}

	protected function register_controls() {
		/** 
		 	-------------------------------
			 Checkbox label title
			-------------------------------
		 */

		$this->start_controls_section(
			'shopengine_title_section',
			[
				'label' => esc_html__('Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_title_color',
			[
				'label'     => esc_html__('Title Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals.shipping td::before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_title_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'text_decoration', 'font_style', 'line_height'],
				'selector' => '{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals.shipping td::before',
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
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
					],
				],
			]
		);

		$this->add_control(
			'shopengine_table_titl_margin_bottom',
			[
				'label'      => esc_html__('Margin Bottom', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'    => [
					'size' => 20,
					'size_units' => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals.shipping td::before' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
			---------------------------------
		  	Content Section
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_content_section',
			[
				'label' => esc_html__('Label style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_payment_label_text_color',
			[
				'label'     => esc_html__('Label Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals ul li :is(label, .amount, span)' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_payment_label_typography',
				'label'    => esc_html__(' Label Typography ', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals ul li :is(label, .amount, span, bdi)',
				'exclude'  => ['letter_spacing', 'text_decoration', 'text_transform', 'font_style', 'letter_spacing'],

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
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '17',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);


		$this->add_control(
			'shopengine_payment_label_gap',
			[
				'label'      => esc_html__('Gap Between', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'    => [
					'size' => 20,
					'size_units' => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-shipping-methods #shipping_method' => 'display:flex; flex-direction: column; gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		


		$this->end_controls_section(); // end ./ content section

		/**
			---------------------------------
		  	checkbox Section
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_payment_methods',
			[
				'label' => esc_html__('Checkbox style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		

		$this->add_responsive_control(
			'shopengine_payment_methods_checkbox_position_y',
			[
				'label'      => esc_html__('Checkbox Position (Y)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals ul li input' => 'transform: translateY({{SIZE}}{{UNIT}});'
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_payment_methods_checkbox_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '8',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals ul li input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],

			]
		);

		

		$this->end_controls_section(); // end ./ checkbox Section
		

		/**
		 	------------------------
		  	Section: Global Font
			------------------------
		*/
		$this->start_controls_section(
			'shopengine_section_style_global',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'shopengine_checkout_shipping_methods_font_family',
				[
					'label'       => esc_html__( 'Font Family', 'shopengine' ),
					'description' => esc_html__( 'This font family is set for this specific widget.', 'shopengine' ),
					'type'        => Controls_Manager::FONT,
					'selectors'   => [
						'{{WRAPPER}} .shopengine-checkout-shipping-methods .woocommerce-shipping-totals :is(th, label, td, td:before)' => 'font-family: {{VALUE}};',
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
