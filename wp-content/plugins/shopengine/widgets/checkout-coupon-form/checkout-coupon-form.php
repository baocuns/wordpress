<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Checkout_Coupon_Form extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Checkout_Coupon_Form_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_checkout_coupon_form_info_style',
			[
				'label' => esc_html__('Info', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_info_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3a3a3a',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle, {{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_info_link_color',
			[
				'label'     => esc_html__('Link Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#4169e1',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_info_link_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#FF3F00',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_info_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#e4e4e4',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_checkout_coupon_form_info_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'text_transform', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '22',
							'unit' => 'px',
						],
					],
					'letter_spacing' => [
						'default' => [
							'size' => '',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_checkout_coupon_form_info_border',
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form',
				'separator'      => 'before',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'label'	  => 'Border Width (px)',
						'default' => [
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '0',
							'left'     => '0',
							'isLinked' => false,
						],
					],
					'color'  => [
						'label'	  => 'Border Color',
						'default' => '#e4e4e4',
						'alpha'   => false
					],
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_info_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '15',
					'right'    => '20',
					'bottom'   => '15',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; margin: 0;',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shopengine_section_checkout_coupon_description_style',
			[
				'label' => esc_html__('Description', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_description_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#707070',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_checkout_coupon_form_description_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form p',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'text_transform', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '400',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '22',
							'unit' => 'px',
						],
					],
					'letter_spacing' => [
						'default' => [
							'size' => '',
						],
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shopengine_section_checkout_coupon_form_style',
			[
				'label' => esc_html__('Coupon Form', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#707070',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form :is(input, input::placeholder)'  => 'color: {{VALUE}} !important;'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_checkout_coupon_form_label_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form input',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'text_transform', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '400',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '14',
							'unit' => 'px',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '40',
							'unit' => 'px',
						],
					],
					'letter_spacing' => [
						'default' => [
							'size' => '',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_checkout_coupon_form_label_border',
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form .form-row input#coupon_code',
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
						'default' => '#dee3ea',
						'alpha'   => false
					],
				],
				'separator'      => 'before',
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_label_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'default'    => [
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_coupon_form_label_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '15',
					'bottom'   => '0',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shopengine_section_checkout_coupon_form_button_style',
			[
				'label' => esc_html__('Apply Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_section_checkout_coupon_form_button_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'letter_spacing'],
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button',
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '38',
							'unit' => 'px',
						],
					],
				],
			]
		);

		$this->start_controls_tabs(
			'shopengine_coupon_form_button_tabs'
		);

		$this->start_controls_tab(
			'shopengine_coupon_form_button_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_coupon_form_button_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_coupon_form_button_background_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_coupon_form_button_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_coupon_form_button_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_coupon_form_button_background_hover_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#645f5f',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_coupon_form_border',
				'selector'       => '{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button',
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
						'default' => '#3A3A3A',
						'alpha'   => false
					],
				],
				'separator'      => 'before',
			]
		);

		$this->add_control(
			'shopengine_coupon_form_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'default'    => [
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'shopengine_coupon_form_button_box_shadow',
				'selector' => '{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button',
			]
		);

		$this->add_control(
			'shopengine_coupon_form_button_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '15',
					'bottom'   => '2',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		//Global font family option
		$this->start_controls_section(
			'shopengine_coupon_form_typography',
			array(
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_coupon_form_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-checkout-coupon-form p,
					{{WRAPPER}} .shopengine-checkout-coupon-form input,
					{{WRAPPER}} .shopengine-checkout-coupon-form .form-row button,
					{{WRAPPER}} .shopengine-checkout-coupon-form .woocommerce-info-toggle' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
