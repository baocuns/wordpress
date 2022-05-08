<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Payment extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Checkout_Payment_Config();
	}

	protected function register_controls() {
		/**
			---------------------------------
		  	Content Section
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_content_section',
			[
				'label' => esc_html__('Content Style', 'shopengine'),
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
					'{{WRAPPER}} .shopengine-checkout-payment .wc_payment_method label' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_payment_url_clr',
			[
				'label'     => esc_html__('Url Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#4169E1',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_payment_url_hover_clr',
			[
				'label'     => esc_html__('Url hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_payment_description_text_color',
			[
				'label'     => esc_html__('Description Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#979797',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment .payment_methods .payment_box'      => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-checkout-payment #payment .payment_methods .payment_box p'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-checkout-payment #payment .payment_methods .payment_box a'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-checkout-payment #payment .woocommerce-privacy-policy-text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_payment_label_typography',
				'label'    => esc_html__('Label Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-payment .wc_payment_method label',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'text_transform', 'font_style', 'letter_spacing'],

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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_payment_content_typography',
				'label'          => esc_html__('Body typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-checkout-payment #payment :is(.payment_box, .woocommerce-terms-and-conditions-wrapper, .payment_method_paypal) :is(p, a)',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'text_transform', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '13',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'label'      => esc_html__('Line-Height (px)', 'shopengine'),
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);


		$this->end_controls_section(); // end ./ content section

		/*
			---------------------------------
		  	checkbox Section
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_payment_methods',
			[
				'label' => esc_html__('Payment Methods', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_payment_methods_checkboxes',
			[
				'label' => esc_html__('Checkboxes', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
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
					'{{WRAPPER}} .shopengine-checkout-payment #payment .wc_payment_method input[type="radio"]'        => 'transform: translateY({{SIZE}}{{UNIT}});'
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
					'{{WRAPPER}} .shopengine-checkout-payment #payment .wc_payment_method input[type="radio"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_payment_methods_list',
			[
				'label'     => esc_html__('Payment Methods List', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_payment_methods_list_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
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
					'{{WRAPPER}} .shopengine-checkout-payment #payment .payment_methods li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'shopengine_payment_methods_list_border_between',
				'label'     => esc_html__('Border', 'shopengine'),
				'selector'  => '{{WRAPPER}} .shopengine-checkout-payment #payment .payment_methods li',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_payment_methods_description',
			[
				'label'     => esc_html__('Payment Methods Description', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_payment_methods_description_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '13',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment .payment_methods .payment_box p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section(); // end ./ checkbox Section 

		/*
			---------------------------------
		  	button
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_payment_order_button',
			[
				'label' => esc_html__('Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_full_width_order_btn',
			[
				'label'        => esc_html__('Full width button', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_responsive_control(
			'shopengine_payment_order_button_space_between',
			[
				'label'      => esc_html__('Space In-between
				', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'condition'  => [
					'shopengine_full_width_order_btn' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-payment .form-row.place-order' => 'grid-template-columns: 100%; grid-gap: {{SIZE}}{{UNIT}} 0;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_payment_order_button_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '15',
					'right'    => '21',
					'bottom'   => '15',
					'left'     => '21',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_input_border',
				'label'    => esc_html__('Border', 'shopengine'),
				'fields_options' => [
					'border'      => [
						'default'    => 'solid',
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'border-style: {{VALUE}};',
						],
					],

					'width' => [
						'label'      => esc_html__('Border Width', 'shopengine'),
						'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1',
							'unit'   => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'responsive' => false,
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'border-color: {{VALUE}};',
						],
					],

				],
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			'shopengine_payment_order_button_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_payment_order_button_typography',
				'label'          => esc_html__('Button Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-checkout-payment #payment #place_order',
				'exclude'        => ['font_family', 'letter_spacing', 'font_style'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '500',
					],
					'font_size'       => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
					'text_decoration' => [
						'default' => 'none',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'shopengine_payment_order_button_shadow',
				'label'    => esc_html__('Box Shadow', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-payment #payment #place_order',
			]
		);

		$this->start_controls_tabs('shopengine_payment_order_button_tabs');

		$this->start_controls_tab(
			'shopengine_payment_order_button_tabs_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_payment_order_button_tabs_normal_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_payment_order_button_tabs_normal_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_payment_order_button_tabs_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_payment_order_button_tabs_hover_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_payment_order_button_tabs_hover_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment #place_order:hover' => 'background: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'shopengine_payment_order_button_wrap_margin',
			[
				'label'      => esc_html__('Wrap Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-payment #payment .form-row.place-order' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section(); // end ./ button
		

		/**
		 * Section: Global Font
		 */
		$this->start_controls_section(
			'shopengine_section_style_global',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'shopengine_archive_products_font_family',
				[
					'label'       => esc_html__('Font Family', 'shopengine'),
					'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
					'type'        => Controls_Manager::FONT,
					'selectors'   => [
						'{{WRAPPER}} .shopengine-checkout-payment .wc_payment_method label,
						 {{WRAPPER}} .shopengine-checkout-payment #payment :is(.payment_box, .woocommerce-terms-and-conditions-wrapper, .payment_method_paypal) :is(p, a),
						 {{WRAPPER}} .shopengine-checkout-payment #payment #place_order' => 'font-family: {{VALUE}};',
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
