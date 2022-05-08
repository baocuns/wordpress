<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Product_Tabs extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Tabs_Config();
	}


	protected function register_controls() {

		/*
			---------------------------------
			  Nav Styles
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_product_nav_style',
			[
				'label' => esc_html__('Nav Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_nav_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .woocommerce-tabs ul.tabs li a',
				'exclude'        => ['letter_spacing', 'text_decoration', 'line_height'],
				'exclude'        => ['font_family', 'text_decoration', 'font_style'],
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
							'size' => '18',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'line_height' => [
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
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->start_controls_tabs(
			'shopengine_product_nav_tabs',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'shopengine_product_tab_nav_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_product_nav_color',
			[
				'label'     => esc_html__('Menu color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#A0A0A0',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-tabs ul.tabs li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_nav_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs ul.tabs li a' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_nav_tab_border',
				'label'          => esc_html__('Nav Border', 'shopengine'),
				// 'selector'       => '{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs',
				'fields_options' => [
					'border_type' => [
						'default' => 'yes',
					],
					'border'      => [
						'default'    => 'solid',
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs li a' => 'border-style: {{VALUE}} !important;',
						],
					],

					'width' => [
						'label'              => esc_html__('Border Width', 'shopengine'),
						// 'allowed_dimensions' => ['top', 'bottom'],
						'default'            => [
							'top' => '0',
							'right'    => '0',
							'bottom'    => '0',
							'left'    => '0',
							'unit'   => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs li a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						],
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs li a' => 'border-color: {{VALUE}} !important;',
						],
					],
				],
				'separator'      => 'before',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_product_tab_nav_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_product_nav_active_color',
			[
				'label'     => esc_html__('Active/Hover Menu Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-tabs ul.tabs :is(li.active a, li:hover a )' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_nav_bg_hover_active_color',
			[
				'label'     => esc_html__('Hover/Active Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs ul.tabs :is(li.active a, li:hover a )' => 'background: {{VALUE}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_nav_hover_active_border_color',
			[
				'label'     => esc_html__('Hover/Active Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs :is(li.active a, li:hover a )' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'shopengine_product_nav_indicator_color',
			[
				'label'     => esc_html__('Nav Indicator Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#5642C7',
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs .shopengine-tabs-line' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_nav_indicator_border',
			[
				'label'              => esc_html__('Nav Indicator Border (px)', 'shopengine'),
				'type'               => Controls_Manager::DIMENSIONS,
				'allowed_dimensions' => ['top', 'bottom'],
				'size_units'         => ['px'],
				'default'            => [
					'top'      => '3',
					'right'    => '0',
					'bottom'   => '3',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .shopengine-product-tabs .wc-tabs .shopengine-tabs-line' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-tabs div.woocommerce-tabs .wc-tabs .shopengine-tabs-line' => 'height: calc(100% + {{TOP}}{{UNIT}} + {{BOTTOM}}{{UNIT}}); top: -{{TOP}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_nav_menu_spacing',
			[
				'label'      => esc_html__('Menu Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce-tabs ul.tabs li:not(:last-child) a' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'shopengine_tab_nav_box_shadow',
				'label'     => esc_html__('Box Shadow', 'shopengine'),
				'selector'  => '{{WRAPPER}} .shopengine-product-tabs .wc-tabs',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_nav_line',
				'label'          => esc_html__('Nav Line', 'shopengine'),
				// 'selector'       => '{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs',
				'fields_options' => [
					'border_type' => [
						'default' => 'yes',
					],
					'border'      => [
						'default'    => 'solid',
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs' => 'border-style: {{VALUE}} !important;',
						],
					],

					'width' => [
						'label'              => esc_html__('Border Width', 'shopengine'),
						'allowed_dimensions' => ['top', 'bottom'],
						'default'            => [
							'bottom' => '1',
							'top'    => '1',
							'unit'   => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						],
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'default'    => '#EFEFEF',
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-tabs div.woocommerce-tabs .wc-tabs' => 'border-color: {{VALUE}} !important;',
						],
					],
				],
				'separator'      => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_tab_nav_item_padding',
			[
				'label'      => esc_html__('Nav Item Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce-tabs ul.tabs li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_tab_nav_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '25',
					'right'    => '0',
					'bottom'   => '25',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce-tabs ul.tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important; margin: 0;',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section(); // end ./ Nav Settings

		/*
			---------------------------
			title styles
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_product_tab_content_style',
			[
				'label' => esc_html__('Tab Content', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_tab_content_title_style',
			[
				'label' => esc_html__('Tab Content Title', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'shopengine_product_tab_content_title_show',
			[
				'label'			=> esc_html__('Show Title', 'shopengine'),
				'type'			=> Controls_Manager::SWITCHER,
				'label_on'		=> esc_html__('Yes', 'shopengine'),
				'label_off'		=> esc_html__('No', 'shopengine'),
				'return_value'	=> 'block',
				'default'		=> 'block',
				'selectors'		=> [
					'{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel > h2:first-child,
					{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel .comment-reply-title' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_content_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel > h2:first-child,
					{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel .woocommerce-Reviews-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'shopengine_product_tab_content_title_show' => 'block',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_content_title_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel > h2:first-child, {{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel .woocommerce-Reviews-title',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '700',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
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
				],
				'condition'      => [
					'shopengine_product_tab_content_title_show' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_content_title_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel > h2:first-child,
					{{WRAPPER}} div.shopengine-product-tabs .woocommerce-Tabs-panel .woocommerce-Reviews-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
                'separator'	=> 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_content_wrap_style',
			[
				'label'     => esc_html__('Tab Content Wrap', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_content_wrap_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '25',
					'right'    => '0',
					'bottom'   => '25',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-tabs .woocommerce-Tabs-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important; margin: 0;',
				],
			]
		);

		$this->end_controls_section(); // end ./title styles

		/*
			---------------------------
			additional info styles
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_product_tab_ainfo_section',
			[
				'label' => esc_html__('Additional Information', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_ainfo_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-tabs tr :is(td, th, p)',
				'exclude'        => ['font_family', 'text_transform', 'text_decoration'],
				'fields_options' => [
					'typography'      => [
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
					'line_height'     => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
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
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_ainfo_tcell_divider_color',
			[
				'label'     => esc_html__('Table Cell Divider Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f2f2f2',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs table tr:not(:last-child)' => 'border-color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_ainfo_tcell_padding',
			[
				'label'      => esc_html__('Table Cell Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '15',
					'right'    => '35',
					'bottom'   => '15',
					'left'     => '35',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-tabs tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-tabs tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// additional info label
		$this->add_control(
			'shopengine_product_tab_ainfo_label_heading',
			[
				'label'     => esc_html__('Label', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
                'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_ainfo_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888888',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs tr th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_ainfo_label_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8f8f8',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs tr th' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_ainfo_label_width',
			[
				'label'      => esc_html__('Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-tabs tr th' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// additional info value
		$this->add_control(
			'shopengine_product_tab_ainfo_value_heading',
			[
				'label'     => esc_html__('Value', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
                'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_ainfo_value_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs tr td p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_ainfo_value_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fdfdfd',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs tr td' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*
			---------------------------
			average rating
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_product_tab_average_rating',
			[
				'label' => esc_html__('Average Rating', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_title_section',
			[
				'label'     => esc_html__('Rating Title', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs #reviews .se-rating-container h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_average_rating_title_typography',
				'label'          => esc_html__(' Label Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-tabs #reviews .se-rating-container h2',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
						'label'   => esc_html__('Line height (px)', 'shopengine'),
						'default' => [
							'size' => '17',
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

		$this->add_control(
			'shopengine_product_tab_average_rating_total_section',
			[
				'label'     => esc_html__('Rating Total', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_total_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-avg-rating' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_average_rating_total_typography',
				'label'          => esc_html__('Label typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-avg-rating',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
							'size' => '48',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '46',
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

		$this->add_control(
			'shopengine_product_tab_average_rating_count_section',
			[
				'label'     => esc_html__('Rating Count', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_count_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-avg-count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_average_rating_count_typography',
				'label'          => esc_html__(' Label Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-avg-count',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
					],
					'line_height' => [
						'label'   => esc_html__('Line height (px)', 'shopengine'),
						'default' => [
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
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_average_section',
			[
				'label'     => esc_html__('Rating Average', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_average_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-ind-rat span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_average_rating_average_typography',
				'label'          => esc_html__('Label Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-ind-rat span',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '17',
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

		$this->add_control(
			'shopengine_product_tab_average_rating_average_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F5F5F5',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-ind-rat-cont' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_average_rating_average_active_bg_color',
			[
				'label'     => esc_html__('Active Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs .se-rating-container .se-ind-rat-cont span' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_average_rating_bar_width',
			[
				'label'      => esc_html__('Rating Bar Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 5,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-tabs #reviews .se-rating-container .se-ind-rat .se-ind-rat-cont' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_average_rating_bar_height',
			[
				'label'      => esc_html__('Rating Bar Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-tabs #reviews .se-rating-container .se-ind-rat :is(.se-ind-rat-cont, .se-ind-rat-cont span)'	=> 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
			---------------------------
			review heading
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_product_tab_review_heading_section',
			[
				'label' => esc_html__('Review Heading', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_tab_heading_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs :is(.woocommerce-Reviews-title, #review_form .comment-reply-title)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tab_heading_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-tabs :is(.woocommerce-Reviews-title, #review_form .comment-reply-title)',
				'exclude'        => ['font_family', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '700',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
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
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'default' => [
							'size' => '0.1',
						],
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_title_margin',
			[
				'label' => esc_html__( 'Margin (px)', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '30',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-tabs :is(.woocommerce-Reviews-title, #review_form .comment-reply-title)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; padding: 0;',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
			---------------------------
			review styles
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_product_tab_style',
			[
				'label' => esc_html__('Review Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_tab_rating_color',
			[
				'label'     => esc_html__('Rating Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEC42D',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .star-rating'								=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .star-rating span'						=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .star-rating span::before'				=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .star-rating::before'						=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews p.stars a'								=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews p.stars.selected a'						=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews p.stars:hover a'							=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews p.stars a::before'						=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews p.stars a.active~a::before'				=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .se-rating-container .star-rating span'		=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .se-rating-container .star-rating::before'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_date_color',
			[
				'label'     => esc_html__('Date, Author and Description Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #reviews .commentlist > li :is(.woocommerce-review__published-date, .description p, .woocommerce-review__author, .woocommerce-review__verified, .woocommerce-review__dash)'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_separator_color',
			[
				'label'     => esc_html__('Comment Separator Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EFEFEF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #reviews #comments .commentlist li'	=> 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_tab_author_typography',
				'label'    => esc_html__('Author Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-tabs .woocommerce-review__author',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'line_height', 'font_style', 'text_transform'],
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
							'size' => '18',
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
				'name'     => 'shopengine_product_tab_date_typography',
				'label'    => esc_html__('Date Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-tabs #reviews .commentlist > li :is(time, .woocommerce-review__published-date, .woocommerce-review__verified)',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'line_height', 'font_style', 'text_transform'],
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
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_tab_description_typography',
				'label'    => esc_html__('Description Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-tabs .description p',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '28',
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

		$this->add_control(
			'shopengine_product_tab_single_spacing',
			[
				'label'      => esc_html__('Single Review Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-tabs #reviews #comments .commentlist li:not(:last-child)'	=> 'margin-bottom: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} div.shopengine-product-tabs #reviews #comments .commentlist li:last-child'		=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section(); // end /review styles

		/*
		   ---------------------------
		   review form
		   ---------------------------
	   */

		$this->start_controls_section(
			'shopengine_product_tab_table',
			[
				'label' => esc_html__('Review Form', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_tab_label_heading',
			[
				'label' => esc_html__('Input Label', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'shopengine_product_tab_label_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9C9C9',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(label, .comment-notes)'	=> 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_label_required',
			[
				'label'     => esc_html__('Required Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EA4335',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .required' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_tab_label_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(label, .comment-notes)',
				'exclude'  => ['font_family', 'text_decoration', 'font_style', 'text_transform'],
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
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '17',
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
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'default' => [
							'size' => '0',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_input_heading',
			[
				'label' => esc_html__('Form Input', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_input_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#B4B4B4',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(input:not([type=checkbox]), textarea)'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_input_border_clr',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F2F2F2',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(textarea, input:not(.submit))' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_input_border_focus_clr',
			[
				'label'     => esc_html__('Focus Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#505255',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(textarea:focus, input:focus, .comment-form-cookies-consent input::after)' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_review_label_input_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(input:not([type=checkbox]), textarea)',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
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
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_field_spacing',
			[
				'label'      => esc_html__('Field Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond :is(.comment-form)'			=> 'margin: 0;',
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(.comment-notes, .comment-form-rating, .comment-form-comment, .comment-form-author, .comment-form-email, .comment-form-cookies-consent)'	=> 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tab_input_border_radius',
			[
				'label'      => esc_html__('Inputs Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(textarea, input)'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'shopengine_product_tab_input_padding',
            [
                'label'      => esc_html__('Inputs Padding (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => true,
				],
                'selectors'  => [
                    '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form :is(textarea, input:not(#wp-comment-cookies-consent, .submit))' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator'  => 'before',
            ]
        );

		$this->end_controls_section(); // end /review form

		/*
			---------------------------------
		  	submit button
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_product_tab_submit_button_section',
			[
				'label' => esc_html__('Submit Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_tab_submit_button_typography',
				'label'    => esc_html__('Button Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
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
				],
			]
		);

        $this->add_responsive_control(
            'shopengine_product_tab_submit_button_alignment',
            [
                'label'     => esc_html__('Alignment', 'shopengine'),
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
                'selectors' => [
                    '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit'			=> 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit'	=> 'float: none;',
                ],
            ]
        );

		$this->start_controls_tabs(
			'shopengine_product_tab_submit_button_tabs',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'shopengine_product_tab_submit_button_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_product_tab_submit_button_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_submit_button_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_product_tab_submit_button_tab_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_product_tab_submit_button_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_submit_button_hover_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tab_submit_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_product_tab_submit_button_border',
				'label'          => esc_html__('Border (px)', 'shopengine'),
				'size_units'     => ['px'],
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'label'	=> esc_html__('Width (px)', 'shopengine'),
						'default' => [
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						],
						'responsive' => false,
					],
					'color'  => [
						'default'	=> '#3A3A3A',
						'alpha'		=> false,
					]
				],
				'selector'       => '{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'shopengine_product_tab_submit_button_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
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
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'shopengine_product_tab_submit_button_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '25',
					'bottom'   => '10',
					'left'     => '25',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-tabs #review_form #respond .comment-form .form-submit input#submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section(); // end ./ submit button

		$this->start_controls_section(
			'shopengine_product_tabs_global_font',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_tabs_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-product-tabs' => 'font-family: {{VALUE}}',
					'{{WRAPPER}} .shopengine-product-tabs :is(a, h2, p, input, tr, th, td, .woocommerce-Tabs-panel, .comment-reply-title)' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();

		add_filter('woocommerce_reviews_title', [$this, 'change_html'], 99, 3);

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}

	public function change_html($reviews_title, $count, $product) {

		$average = $product->get_average_rating();

		$rating_5 = $product->get_rating_count(5);
		$rating_4 = $product->get_rating_count(4);
		$rating_3 = $product->get_rating_count(3);
		$rating_2 = $product->get_rating_count(2);
		$rating_1 = $product->get_rating_count(1);
		$total = $rating_1 + $rating_2 + $rating_3 + $rating_4 + $rating_5;
		$pct5 = $pct4 = $pct3 = $pct2 = $pct1 = 0;

		if ($total > 0) {
			$pct5 = ceil($rating_5 * 100 / $total);
			$pct4 = ceil($rating_4 * 100 / $total);
			$pct3 = ceil($rating_3 * 100 / $total);
			$pct2 = ceil($rating_2 * 100 / $total);
			$pct1 = ceil($rating_1 * 100 / $total);
		}

		$details = '<div class="se-ind-rat"><span>' . esc_html__('5 star', 'shopengine') . '</span> <span class="se-ind-rat-cont"><span style="width: ' . $pct5 . '%"> </span></span> <span>' . $pct5 . '%</span></div><br/> ';
		$details .= '<div class="se-ind-rat"><span>' . esc_html__('4 star', 'shopengine') . '</span> <span class="se-ind-rat-cont"><span style="width: ' . $pct4 . '%"> </span></span> <span>' . $pct4 . '%</span></div><br/> ';
		$details .= '<div class="se-ind-rat"><span>' . esc_html__('3 star', 'shopengine') . '</span> <span class="se-ind-rat-cont"><span style="width: ' . $pct3 . '%"> </span></span> <span>' . $pct3 . '%</span></div><br/> ';
		$details .= '<div class="se-ind-rat"><span>' . esc_html__('2 star', 'shopengine') . '</span> <span class="se-ind-rat-cont"><span style="width: ' . $pct2 . '%"> </span></span> <span>' . $pct2 . '%</span></div><br/> ';
		$details .= '<div class="se-ind-rat"><span>' . esc_html__('1 star', 'shopengine') . '</span> <span class="se-ind-rat-cont"><span style="width: ' . $pct1 . '%"> </span></span> <span>' . $pct1 . '%</span></div><br/> ';


		$htm = '</h2>';
		$htm .= '<div class="se-rating-container">';
		$htm .= '<h2>Average rating</h2>';
		$htm .= '<div class="se-avg-rating">' . $average . '</div>';

		$htm .= wc_get_rating_html($average, $count);

		$htm .= '<strong class="se-avg-count">' . $count . ' Review</strong>';
		$htm .= $details;
		$htm .= '</div><h2 class="woocommerce-Reviews-title">';

		return $htm . $reviews_title;
	}
}
