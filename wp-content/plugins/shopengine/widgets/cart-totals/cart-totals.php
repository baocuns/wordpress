<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Cart_Totals extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Cart_Totals_Config();
	}

	protected function register_controls() {

		/*
		 	-------------------------------
			 Style Tab - Cart Table
			-------------------------------
		 */
		
		$this->start_controls_section(
			'shopengine_cart_table_section',
			array(
				'label' => esc_html__('Table', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_cart_totals_typography',
				'label'			=> 'Title and Price Typography',
				'selector'       => '{{WRAPPER}} .shopengine-cart-totals :is(a:not(.checkout-button), tr, td, th, #shipping_method .price, #shipping_method .amount)',
				'exclude'		 => ['font_family', 'text_decoration', 'font_style'], 
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_family'    => [
						'default' => 'Barlow',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
					],
					'font_weight'    => [
						'default' => '600',
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '22',
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
					'letter_spacing' => [
						'default' => [
							'size' => '0.4',
						],
					],
				],
			)
		);

		$this->add_control(
			'shopengine_cart_totals_table_heading_color',
			[
				'label'     => esc_html__('Title Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#404040',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals .shop_table tr th'                 => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-cart-totals .shop_table tr.shipping td:before' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_cart_totals_table_data_color',
			[
				'label'     => esc_html__('Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#505255',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals .shop_table tr :is(td, td *, td::before)' => 'color: {{VALUE}};'
				],
			]
		);

		/*
		 * Style heading - Shipping Methods
		 */
		$this->add_control(
			'sshopengine_cart_totals_shipping_methods_headings',
			array(
				'label'     => esc_html__('Shipping Methods', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'shopengine_cart_totals_shipping_methods_heading_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#505255',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals tr.shipping :is(ul li label, p, form a)'				=> 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-cart-totals tr.shipping ul li input[type=radio]'                	=> 'border-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-cart-totals tr.shipping ul li input[type=radio]:checked'        	=> 'border-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-cart-totals tr.shipping ul li input[type=radio]:checked:before' 	=> 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_cart_totals_shipping_methods_heading_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-cart-totals tr.shipping :is(ul li label, form a, p)',
				'exclude'		=> ['font_family', 'text_decoration', 'font_style'], 
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
					],
					'font_weight'    => [
						'default' => '400',
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
					'letter_spacing' => [
						'default' => [
							'size' => '0.4',
						],
					],
				],
			)
		);
		
		$this->add_control(
			'shopengine_ship_method_desc',
			[
				'type'				=> Controls_Manager::RAW_HTML,
				'raw'				=> esc_html__( 'Shipping Methods can be added from WooCommerce > Settings > Shipping.', 'shopengine' ),
				'content_classes'	=> 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		/*
		 * Style heading - Table Row
		 */
		$this->add_control(
			'shopengine_cart_totals_table_row_heading',
			array(
				'label'     => esc_html__('Table Row', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_cart_totals_table_row_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-cart-totals .shop_table tr:not(:last-of-type)',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'label'	=> esc_html__('Width (px)', 'shopengine'),
						'allowed_dimensions' => ['bottom'],
						'size_units' => ['px'],
						'default' => [
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '1',
							'left'     => '0',
							'isLinked' => false,
						],
					],
					'color'  => [
						'default'	=> '#DEDFE2',
						'alpha'		=> false,
					]
				],
			]
		);

		$this->add_control(
			'shopengine_cart_totals_table_row_spacing',
			[
				'label'      => esc_html__('Row Spacing (px)', 'shopengine'),
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
					'size' => 26,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-totals .shop_table tr:not(:first-of-type) :is(td, th)'	=> 'padding: {{SIZE}}{{UNIT}} 0;',
					'{{WRAPPER}} .shopengine-cart-totals .shop_table tr:first-of-type :is(td, th)'			=> 'padding: 0 0 {{SIZE}}{{UNIT}} 0;',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();


		/*
		 	-------------------------------
			Table Input controls
			-------------------------------
		*/

		$this->start_controls_section(
			'shopengine_section_ct_input_section',
			array(
				'label' => esc_html__('Input', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);


		$this->add_control(
			'shopengine_input_input_font_size',
			[
				'label'      => esc_html__('Font Size (px)', 'shopengine'),
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
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-selection)'	=> 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_input_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	 => [
					'top'	=> 12,
					'right'	=> 20,
					'bottom'=> 12,
					'left'	=> 20,
					'size_unit' => 'px',
					'is_linked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-selection__rendered)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'shopengine_input_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	 => [
					'top'	=> 10,
					'right' => 0,
					'bottom'=> 10,
					'left'	=> 0,
					'size_unit' => 'px',
					'is_linked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-container)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
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
				'alpha'		=> false,
				'default'	=> '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-selection)' => 'color: {{VALUE}};',

				],
				'default'   => '#101010',
			]
		);

		$this->add_control(
			'shopengine_input_background',
			[
				'label'     => esc_html__('Input Background color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, select2-container, .select2-container)' => 'background-color: {{VALUE}} !important;',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_input_border',
				'label'    => esc_html__('Border', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-container)',
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
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-selection):focus' => 'color: {{VALUE}};',
				],
				'default'   => '#000000',
			]
		);


		$this->add_control(
			'shopengine_input_background_focus',
			[
				'label'     => esc_html__('Input Background color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-container, .select2-container):focus' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_input_border_focus',
				'label'    => esc_html__('Border', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-cart-totals .woocommerce-shipping-calculator :is(select, input, .select2-container):focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		


		$this->end_controls_section();

		/*
			-------------------------------
		 	Style Tab - Checkout/update Button
			-------------------------------
		 */
		$this->start_controls_section(
			'shopengine_section_cart_totals_checkout_button',
			array(
				'label' => esc_html__('Checkout and Update Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_cart_totals_checkout_button_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-cart-totals .wc-proceed-to-checkout :is(a, .button, button, .checkout-button)',
				'exclude'		 => ['font_family', 'text_decoration', 'font_style'], 
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
					],
					'font_weight'    => [
						'default' => '500',
					],
					'text_transform' => [
						'default' => 'none',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '19',
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
					'letter_spacing' => [
						'default' => [
							'size' => '-0.4',
						],
					],
				],
			)
		);

		$this->start_controls_tabs(
			'shopengine_cart_totals_checkout_button_tabs'
		);

		$this->start_controls_tab(
			'shopengine_cart_totals_checkout_button_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_cart_totals_checkout_button_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button)' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_cart_totals_checkout_button_background_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button)' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_cart_totals_checkout_button_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_cart_totals_checkout_button_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button):hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_cart_totals_checkout_button_background_hover_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#707070',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button):hover' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_cart_totals_checkout_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#707070',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button)' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'shopengine_cart_totals_checkout_button_border',
				'selector'  => '{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button)',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_cart_totals_checkout_button_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_cart_totals_checkout_button_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '13',
					'right'    => '5',
					'bottom'   => '13',
					'left'     => '5',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-cart-totals :is(.wc-proceed-to-checkout .button, button)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		/*
		 	--------------------------
			 Style Tab - Global Font
			--------------------------
		 */
		$this->start_controls_section(
			'shopengine_cart_totals_global_font_section',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_cart_totals_global_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'selectors'   => [
					'{{WRAPPER}} .shopengine-cart-totals :is(a, h2, tr, td, th, .price, .amount, span,)' => 'font-family: {{VALUE}};',
				],
			]
		);
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();
		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
