<?php

namespace Elementor;


use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Checkout_Form_Billing extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Checkout_Form_Billing_Config();
	}


	protected function register_controls() {
		/**
		 * Style Controls
		 */
		$this->start_controls_section(
			'shopengine_title_section',
			[
				'label' => esc_html__('Form Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_layout_heading_status',
			[
				'label'        => esc_html__('Enable Default Title', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields > h3' => 'display: block;',
				],
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'shopengine_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields > h3' => 'color: {{VALUE}}',
				],
				'condition' => [
					'shopengine_layout_heading_status' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_title_font_size',
			[
				'label'      => esc_html__('Font Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 64,
					],
				],
				'default'    => [
					'size' => 22,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields > .shopengine-billing-address-header' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
				'condition'  => [
					'shopengine_layout_heading_status' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_title_margin',
			[
				'label'      => esc_html__('Margin', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'unit'     => 'px',
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 25,
					'left'     => 0,
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_layout_heading_status' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/*================================ 
		Checkout Form Visibility Start

		- shopengine_hide_billing_first_name_field
		- shopengine_hide_billing_last_name_field
		- shopengine_hide_billing_company_field
		- shopengine_hide_billing_country_field
		- shopengine_hide_billing_address_1_field
		- shopengine_hide_billing_address_2_field
		- shopengine_hide_billing_city_field
		- shopengine_hide_billing_state_field
		- shopengine_hide_billing_postcode_field
		- shopengine_hide_billing_phone_field
		- shopengine_hide_billing_email_field
		
		==================================*/ 

		$this->start_controls_section(
			'shopengine_checkout_form_visibility',
			[
				'label' => esc_html__('Field Visibility', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_hide_billing_first_name_field',
			[
				'label'        => esc_html__('Hide First Name', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_first_name_field' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_hide_billing_last_name_field',
			[
				'label'        => esc_html__('Hide Last Name', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_last_name_field' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_hide_billing_company_field',
			[
				'label'        => esc_html__('Hide Company Name', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_company_field' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_hide_billing_country_field',
			[
				'label'        => esc_html__('Hide Country/Region Name', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_country_field' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_hide_billing_address_1_field',
			[
				'label'        => esc_html__('Hide Street Address 1', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_address_1_field' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_hide_billing_address_2_field',
			[
				'label'        => esc_html__('Hide Street Address 2', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_address_2_field' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_hide_billing_city_field',
			[
				'label'        => esc_html__('Hide town/city', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_city_field' => 'display: none;',
				],
			]
		);
		
		
		$this->add_control(
			'shopengine_hide_billing_state_field',
			[
				'label'        => esc_html__('Hide state', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_state_field' => 'display: none;',
				],
				]
			);
			
		$this->add_control(
			'shopengine_hide_billing_postcode_field',
			[
				'label'        => esc_html__('Hide ZIP/Postcode', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_postcode_field' => 'display: none;',
				],
			]
		);
		
		$this->add_control(
			'shopengine_hide_billing_phone_field',
			[
				'label'        => esc_html__('Hide phone', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_phone_field' => 'display: none;',
				],
			]
		);
		
		$this->add_control(
			'shopengine_hide_billing_email_field',
			[
				'label'        => esc_html__('Hide email address', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields #billing_email_field' => 'display: none;',
				],
			]
		);

		$this->end_controls_section();
		/*================================ 
		Checkout Form Visibility end
		==================================*/ 

		$this->start_controls_section(
			'shopengine_form_container_section',
			[
				'label' => esc_html__('Form Container', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_form_container_background',
			[
				'label'     => esc_html__('Container Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#f7f8fb',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_continer_alignment',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__('Left', 'shopengine'),
						'icon'        => 'eicon-text-align-left',
					],
					'right'  => [
						'title' => esc_html__('Right', 'shopengine'),
						'icon'        => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper .woocommerce-input-wrapper input' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper .woocommerce-input-wrapper select' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'shopengine_form_container_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'    => 25,
					'right'  => 30,
					'bottom' => 25,
					'left'   => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
			---------------------------
			Form Label start
			---------------------------
		*/ 

		$this->start_controls_section(
			'shopengine_input_label_section',
			[
				'label' => esc_html__('Label', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_input_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_input_required_indicator_color',
			[
				'label'     => esc_html__('Required Indicator Color:', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#3A3A3A',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row label abbr' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_label_font_size',
			[
				'label'      => esc_html__('Font Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 64,
					],
				],
				'default'    => [
					'size' => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row label' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_input_label_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // end ./ form label


		/*
			---------------------------
			Form Input
			---------------------------
		*/ 

		$this->start_controls_section(
			'shopengine_input_section',
			[
				'label' => esc_html__('Input', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('shopengine_input_tabs_style');

		$this->start_controls_tab(
			'shopengine_input_tabnormal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_input_color',
			[
				'label'     => esc_html__('Input Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .woocommerce-input-wrapper .select2-selection, select)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_input_background',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .select2-selection, select)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_input_font_size',
			[
				'label'      => esc_html__('Font Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'size' => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .select2-selection, select)' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
				'condition'  => [
					'shopengine_layout_heading_status' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_input_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'responsive' => false,
						'default' => [
							'top'      => 1,
							'right'    => 1,
							'bottom'   => 1,
							'left'     => 1,
							'isLinked' => true,
						],
					],
					'color'  => [
						'default' => '#dee3ea',
						'alpha'	  => false,
					],
				],
				'selector'       => '{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .woocommerce-input-wrapper .select2-selection, select)',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_input_tabfocus',
			[
				'label' => esc_html__('Focus', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_input_color_focus',
			[
				'label'     => esc_html__('Input Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .select2-selection, select):focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_input_background_focus',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .select2-selection, select):focus'  => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_input_border_focus',
				'label'    => esc_html__('Border', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .select2-selection, select):focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'shopengine_input_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'    => 10,
					'right'  => 16,
					'bottom' => 10,
					'left'   => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .woocommerce-input-wrapper .select2-selection, select)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_input_color_placeholder',
			[
				'label'     => esc_html__('Placeholder Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper :is(input, textarea, .woocommerce-input-wrapper .select2-selection, select)::placeholder' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();

		/**
		 * Typography Section
		 */
		$this->start_controls_section(
			'shopengine_typography_section',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_typography_primary',
				'label'    => esc_html__('Primary Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields > h3, {{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row label',
				'exclude'  => ['letter_spacing', 'font_size', 'text_decoration', 'font_style', 'line_height'],
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
							'size' => '16',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_typography_primary_desc',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__('Primary Typography : Form Title & Form Label', 'shopengine'),
				'content_classes' => 'elementor-control-field-description',
				'separator'       => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_typography_seconday',
				'label'    => esc_html__('Secondary Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row input,
					{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row textarea,
					{{WRAPPER}} .shopengine-checkout-form-billing .woocommerce-billing-fields__field-wrapper .form-row .select2-selection',
				'exclude'  => ['font_style','font_size', 'letter_spacing','line_height', 'text_decoration'],
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
							'size' => '16',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_typography_secondary_desc',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__('Secondary Typography : Form Input', 'shopengine'),
				'content_classes' => 'elementor-control-field-description',
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
