<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Checkout_Form_Additional extends \ShopEngine\Base\Widget
{


	public function config() {
		return new ShopEngine_Checkout_Form_Additional_Config();
	}


	protected function register_controls() {
		/**
		 * Section: Heading
		 */
		$this->start_controls_section(
			'shopengine_section_style_heading',
			[
				'label' => esc_html__( 'Heading', 'shopengine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'shopengine_checkout_form_additional_heading',
				[
					'label'       => esc_html__( 'Show heading', 'shopengine' ),
					'type'        => Controls_Manager::SWITCHER,
					'default'	  => 'yes',
					'selectors'   => [
						'{{WRAPPER}} .shopengine-checkout-form-additional h3' => 'display: block;',
					],
				]
			);
			
			$this->add_control(
				'shopengine_checkout_form_additional_heading_color',
				[
					'label'       => esc_html__( 'Color', 'shopengine' ),
					'type'        => Controls_Manager::COLOR,
					'alpha'		  => false,
					'selectors'   => [
						'{{WRAPPER}} .shopengine-checkout-form-additional h3' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'shopengine_checkout_form_additional_heading_size',
				[
					'label'      => esc_html__( 'Font Size (px)', 'shopengine' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-checkout-form-additional h3' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			
			$this->add_control(
				'shopengine_checkout_form_additional_heading_spacing',
				[
					'label'      => esc_html__( 'Spacing Bottom (px)', 'shopengine' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .shopengine-checkout-form-additional h3' => 'padding-bottom: {{SIZE}}{{UNIT}} !important;',
					],
					'separator'	 => 'before',
				]
			);
		$this->end_controls_section();


		/*
			---------------------------------
			Form label
			---------------------------------
		*/

		$this->start_controls_section(
			'shopengine_heading_checkout_form_additional_label',
			[
				'label' => esc_html__('Form Label', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_checkout_form_additional_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .form-row label' => 'display: block; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_orders_body_text_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-form-additional .form-row label',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'text_decoration', 'font_style', 'line_height'],
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
							'size' => '15',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
					],
				],
			]
		);


		$this->add_control(
			'shopengine_checkout_form_additional_label_line_height',
			[
				'label'      => esc_html__('Spacing Bottom (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
					'size' => '9',
				],
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .form-row label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'separator'	 => 'before',
			]
		);


		$this->end_controls_section();

		/*
			---------------------------------
			textarea styles
			---------------------------------
		*/

		$this->start_controls_section(
			'shopengine_heading_checkout_form_additional_textarea',
			[
				'label' => esc_html__('Form Textarea', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_checkout_form_additional_textarea_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .input-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_form_additional_textarea_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .input-text' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_form_additional_textarea_placeholder_color',
			[
				'label'     => esc_html__('Placeholder color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .input-text::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_checkout_form_additional_textarea_typography',
				'label'    => esc_html__('Text Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-form-additional .input-text',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'text_decoration', 'font_style'],
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
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'      => esc_html__('Line-height (px)', 'shopengine'),
						'default'    => [
							'size' => '17',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);


		$this->add_responsive_control(
			'shopengine_checkout_form_additional_textarea_height',
			[
				'label'      => esc_html__('Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 90,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-additional textarea[name=order_comments]' => 'height: {{SIZE}}{{UNIT}}; width: 100%; background-image: none;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_checkout_form_additional_textarea_margin',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'default'    => [
					'top'      => '10',
					'right'    => '18',
					'bottom'   => '10',
					'left'     => '18',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_checkout_form_additional_border',
				'selector'       => '{{WRAPPER}} .shopengine-checkout-form-additional .form-row .input-text',
				'separator'      => 'before',
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
					],
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_form_additional_textarea_focus_color',
			[
				'label'     => esc_html__('Focus Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dee3ea',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-additional .form-row .input-text:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'shopengine_checkout_form_additional_border_border!' => '',
				],
			]
		);

		$this->add_control(
			'shopengine_checkout_form_additional_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
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
					'{{WRAPPER}} .shopengine-checkout-form-additional .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		

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
				'shopengine_checkout_form_additional_font_family',
				[
					'label'       => esc_html__( 'Font Family', 'shopengine' ),
					'description' => esc_html__( 'This font family is set for this specific widget.', 'shopengine' ),
					'type'        => Controls_Manager::FONT,
					'selectors'   => [
						'{{WRAPPER}} .shopengine-checkout-form-additional h3,
						 {{WRAPPER}} .shopengine-checkout-form-additional .form-row label,
						 {{WRAPPER}} .shopengine-checkout-form-additional .input-text' => 'font-family: {{VALUE}};',
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
