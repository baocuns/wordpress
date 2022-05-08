<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Product_Price extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Product_Price_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_price_style',
			[
				'label' => esc_html__('Price', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_product_price_text_align',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'default'	=> 'flex-start',
				'options'   => [
					'flex-start'	=> [
						'title'		=> esc_html__('Left', 'shopengine'),
						'icon'		=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title' 	=> esc_html__('Center', 'shopengine'),
						'icon'  	=> 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' 	=> esc_html__('Right', 'shopengine'),
						'icon'  	=> 'eicon-text-align-right',
					],
				],
				'toggle'	=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-price .price' => 'display: flex; align-items: center; justify-content: {{VALUE}};',
					'{{WRAPPER}} .shopengine-product-price .price del, {{WRAPPER}} .shopengine-product-price .price ins' => 'background: none;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'         	=> 'shopengine_product_price_typography',
				'selector'    	=> '{{WRAPPER}} .shopengine-product-price :is(.price, .price .amount, .price ins)',
				'exclude'		=> ['text_transform', 'text_decoration', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '600',
					],
					'font_size'       => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'	=> [
							'size' => '28',
							'unit' => 'px'
						]
					],
					'text_transform'  => [
						'default' => 'uppercase',
					],
					'text_decoration' => [
						'default' => 'none',
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '30',
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
					'letter_spacing'  => [
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'size_units' => ['px'],
						'default' => [
							'size' => '0.1',
						]
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_price_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-price :is(.price, .price del, .price del .amount, .price ins )' => 'color: {{VALUE}}; opacity: 1; vertical-align: middle;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_price_space_between',
			[
				'label'      => esc_html__('Space In-between
				(px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'size' => 8,
					'unit' => 'px'
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-price .price del'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-price .price .shopengine-discount-badge'   => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .shopengine-product-price .price del'   => 'margin-left: {{SIZE}}{{UNIT}}; margin-right:0px;',
					'.rtl {{WRAPPER}} .shopengine-product-price .price .shopengine-discount-badge'   => 'margin-right: {{SIZE}}{{UNIT}}; margin-left:0px;',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_price_sale_heading',
			[
				'label'     => esc_html__('Sale Price', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_price_sale_price_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-price .price ins .amount' => ' background: transparent; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'         	=> 'shopengine_product_price_sale_price_typography',
				'selector'    	=> '{{WRAPPER}} .shopengine-product-price .price ins .amount',
				'exclude'		=> ['line_height', 'text_transform', 'text_decoration', 'font_style', 'letter_spacing', 'word_spacing'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '600',
					],
					'font_size'       => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'	=> [
							'size' => '14',
							'unit' => 'px'
						]
					],
					'text_transform'  => [
						'default' => 'uppercase',
					],
					'text_decoration' => [
						'default' => 'none',
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '30',
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
					'letter_spacing'  => [
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'size_units' => ['px'],
						'default' => [
							'size' => '0.1',
						]
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_style',
			[
				'label'     => esc_html__('Discount Badge', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__('Discount badge shows when a product has a sale price.', 'shopengine'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_price_discount_badge_typography',
				'selector'       => '{{WRAPPER}} .shopengine-product-price .price .shopengine-discount-badge',
				'exclude'		=> ['text_decoration', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '400',
					],
					'font_size'       => [
						'size_units' => ['px'],
						'default' => [
							'size' => '12',
							'unit' => 'px'
						]
					],
					'text_transform'  => [
						'default' => 'uppercase',
					],
					'line_height'     => [
						'size_units' => ['px'],
						'default' => [
							'size' => '20',
							'unit' => 'px'
						]
					],
					'letter_spacing'  => [
						'default' => [
							'size' => '',
						]
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-price .price .shopengine-discount-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#EA4335',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-price .price .shopengine-discount-badge' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_price_discount_badge_padding',
			[
				'label'	=> esc_html__( 'Badge Padding (px)', 'shopengine' ),
				'type'	=> Controls_Manager::DIMENSIONS,
				'selectors'	=> [
					'{{WRAPPER}} .shopengine-product-price .price .shopengine-discount-badge' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
