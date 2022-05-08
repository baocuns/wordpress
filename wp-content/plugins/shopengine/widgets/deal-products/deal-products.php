<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Deal_Products extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Deal_Products_Config();
	}
	

	protected function register_controls() {
		/*
			-------------------------
			layout content start
			-------------------------
		*/ 
		$this->start_controls_section(
			'shopengine_layout_content',
			[
				'label'	=> esc_html__( 'Layout and Product', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_order',
			[
				 'label' => esc_html__('Order', 'shopengine'),
				 'type' => Controls_Manager::SELECT,
				 'default'   => esc_html__('DESC', 'shopengine'),
				 'options'   => [
					  'ASC'   => esc_html__('ASC', 'shopengine'),
					  'DESC'  => esc_html__('DESC', 'shopengine'),
				 ],
			]
	  );

	  $this->add_control(
		'product_orderby',
		[
			 'label'=> esc_html__('Order By', 'shopengine'),
			 'type' => Controls_Manager::SELECT,
			 'default' => esc_html( 'date', 'shopengine' ),
			 'options' => [
				  'ID'     => esc_html__('ID', 'shopengine'),
				  'title'  => esc_html__('Title', 'shopengine'),
				  'date'   => esc_html__('Date', 'shopengine'),
				  'comment_count' => esc_html__('Popular', 'shopengine'),
			 ],
		]
  );

		$this->add_control(
			'products_per_page',
			[
				'label'	=> esc_html__( 'Show Product', 'shopengine' ),
				'type'	=> Controls_Manager::NUMBER,
				'min'		=> 1,
				'max'		=> 100,
				'step'	=> 1,
				'default' => 4
			]
		);

		$this->add_responsive_control(
			'shopengine_layout_column',
			[
				'label'	=> esc_html__( 'Column', 'shopengine' ),
				'type'	=> Controls_Manager::NUMBER,
				'min'		=> 1,
				'max'		=> 100,
				'step'	=> 1,
				'default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 1,
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
			  ],
			]
		);

		$this->add_responsive_control(
			'shopengine_layout_product_col_gap',
			[
				'label'	=> esc_html__( 'Column Gap', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products-container' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_layout_product_row_gap',
			[
				'label'	=> esc_html__( 'Row Gap', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products-container' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// layout contnet end

		/*
			-------------------------
			badge content 
			-------------------------
		*/ 
		/*
			-------------------------
			content settigns
			-------------------------
		*/ 
		$this->start_controls_section(
			'shopengine_content_settings',
			[
				'label'	=> esc_html__( 'Settings', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shopengine_is_sale_badge',
			[
				'label'	=> esc_html__( 'Enable Sale Badge', 'shopengine' ),
				'type'	=> Controls_Manager::SWITCHER,
				'label_on'	=> esc_html__( 'Show', 'shopengine' ),
				'label_off' => esc_html__( 'Hide', 'shopengine' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'shopengine_sale_badge_text',
			[
				'label'	=> esc_html__( 'Sale badge', 'shopengine' ),
				'type'	=> Controls_Manager::TEXT,
				'default'	=> esc_html__( 'Sale', 'shopengine' ),
				'placeholder' => esc_html__( 'Add sale badge', 'shopengine' ),
				'condition'	=> [
					'shopengine_is_sale_badge'	=> 'yes'
				],
			]
		);


		$this->add_control(
			'title_word_limit',
			[
				'label'	=> esc_html__( 'Title Word Limit', 'shopengine' ),
				'type'	=> Controls_Manager::NUMBER,
				'min'		=> 1,
				'max'		=> 100,
				'step'	=> 1,
				'default' => 3
			]
		);

		$this->add_control(
			'shopengine_show_percentage_badge',
			[
				'label'	=> esc_html__( 'Percentage Badge', 'shopengine' ),
				'type'	=> Controls_Manager::SWITCHER,
				'label_on'	=> esc_html__( 'Show', 'shopengine' ),
				'label_off' => esc_html__( 'Hide', 'shopengine' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'shopengine_show_countdown_clock',
			[
				'label'	=> esc_html__( 'Countdown Clock', 'shopengine' ),
				'type'	=> Controls_Manager::SWITCHER,
				'label_on'	=> esc_html__( 'Show', 'shopengine' ),
				'label_off' => esc_html__( 'Hide', 'shopengine' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'shopengine_show_countdown_clock_days',
			[
				'label'	=> esc_html__( 'Days', 'shopengine' ),
				'type'	=> Controls_Manager::SWITCHER,
				'label_on'	=> esc_html__( 'Show', 'shopengine' ),
				'label_off' => esc_html__( 'Hide', 'shopengine' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'shopengine_show_countdown_clock' => 'yes'
				]
			]
		);

		$this->add_control(
            'shopengine_show_sold_chart',
            [
                'label'        => esc_html__('Sold Chart', 'shopengine'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'shopengine'),
                'label_off'    => esc_html__('Hide', 'shopengine'),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

		$this->end_controls_section();
		// end of content settings


		/*
			-------------------------
			content settigns
			-------------------------
		*/ 
		$this->start_controls_section (
			'shopengine_product_wrapper',
			[
				'label'	=> esc_html__( 'Product wrapper', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_deal_padding',
			[
				'label'=> esc_html__( 'Padding', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '25',
					'right'	=> '25',
					'bottom' => '25',
					'left' => '25',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_wrapper_bg',
			[
				'label'	=> esc_html__( 'Background Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_wrapper_border_width',
			[
				'label'=> esc_html__( 'Border Width', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '1',
					'right'	=> '1',
					'bottom' => '1',
					'left' => '1',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products ' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_wrapper_border_clr',
			[
				'label'	=> esc_html__( 'Border Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#E6EBF0',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		//content settigns

		/*
			-------------------------
			product iamge
			-------------------------
		*/ 
		$this->start_controls_section (
			'shopengine_product_image_styles',
			[
				'label'	=> esc_html__( 'Product Image', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_product_image_height',
			[
				'label'	=> esc_html__( 'Height', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__top--img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_image_size',
			[
				 'label' => esc_html__('Size', 'shopengine'),
				 'type' => Controls_Manager::SELECT,
				 'options'   => [
					  'contain'   => esc_html__('Contain', 'shopengine'),
					  'cover'  => esc_html__('Cover', 'shopengine'),
				 ],
				 'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__top--img' => 'object-fit: {{VALUE}};',
				],
			]
	  );

		$this->add_control(
			'shopengine_product_image_position',
			[
				 'label' => esc_html__('Position', 'shopengine'),
				 'type' => Controls_Manager::SELECT,
				 'default'   => esc_html__('center', 'shopengine'),
				 'options'   => [
					  'top'   => esc_html__('Top', 'shopengine'),
					  'center'  => esc_html__('Center', 'shopengine'),
					  'bottom'  => esc_html__('Bottom', 'shopengine'),
				 ],
				 'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__top--img' => 'object-position: {{VALUE}};',
				],
				
				'condition' => [
					'shopengine_product_image_size' => 'cover'
				]
			]
	  );



		$this->end_controls_section();
		// end ./ product iamge

		/*
			-------------------------
			percentage badge
			-------------------------
		*/ 
		$this->start_controls_section (
			'shopengine_product_percentage',
			[
				'label'	=> esc_html__( 'Percentage Badge', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_percentage_badge' => 'yes'
				]
			]
		);

		$this->add_control(
			'shopengine_product_percentage_padding',
			[
				'label'=> esc_html__( 'Padding', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '0',
					'right'	=> '10',
					'bottom' => '0',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_percentage_radius',
			[
				'label'=> esc_html__( 'Border radius', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '5',
					'right'	=> '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_percentage_position_left',
			[
				'label'	=> esc_html__( 'Position left', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_percentage_position_top',
			[
				'label'	=> esc_html__( 'Position top', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_percentage_clr',
			[
				'label'	=> esc_html__( 'Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_percentage_bg_clr',
			[
				'label'	=> esc_html__( 'Background', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#3E3E3E',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_percentage_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height', 'text_transform'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '12',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);


		$this->end_controls_section();
		// end ./ 	percentage badge

		
		/*
			-------------------------
			sale badge 
			-------------------------
		*/ 

		$this->start_controls_section (
			'shopengine_product_sale_badge',
			[
				'label'	=> esc_html__( 'Sale badge', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_is_sale_badge' => 'yes'
				]
			]
		);

		$this->add_control(
			'shopengine_product_sale_padding',
			[
				'label'=> esc_html__( 'Paddig', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '0',
					'right'	=> '10',
					'bottom' => '0',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_sale_radius',
			[
				'label'=> esc_html__( 'Border radius', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '5',
					'right'	=> '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_sale_position_left',
			[
				'label'	=> esc_html__( 'Position left', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_sale_position_top',
			[
				'label'	=> esc_html__( 'Position top', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_sele_clr',
			[
				'label'	=> esc_html__( 'Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_sale_bg_clr',
			[
				'label'	=> esc_html__( 'Background', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#784ED5',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_sale_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge',
				'exclude'  => ['font_family', 'text_decoration', 'font_style'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '12',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->end_controls_section();
		// sale badge end

		/*
			-------------------------
			countdown clock
			-------------------------
		*/ 
		$this->start_controls_section (
			'shopengine_product_countDown_clock',
			[
				'label'	=> esc_html__( 'Countdown Clock', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_countdown_clock' => 'yes'
				]
			]
		);

		$this->add_control(
			'shopengine_product_countDown_number_clr',
			[
				'label'	=> esc_html__( 'Number Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item span:first-child' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_countDown_number_typography',
				'label'    => esc_html__('Number Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-countdown-clock .se-clock-item span:first-child',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height', 'text_transform'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '20',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_label_clr',
			[
				'label'	=> esc_html__( 'Label Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#888888',
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item span:last-child' => 'color: {{VALUE}}',
				],
			]
		);

		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_countDown_label_typography',
				'label'    => esc_html__('Label Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-countdown-clock .se-clock-item span:last-child',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line-height'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '14',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_bg',
			[
				'label'	=> esc_html__( 'Background', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_border_clr',
			[
				'label'	=> esc_html__( 'Border Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#F2F2F2',
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_border_width',
			[
				'label'=> esc_html__( 'Border Width', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '1',
					'right'	=> '1',
					'bottom' => '1',
					'left' => '1',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_padding',
			[
				'label'=> esc_html__( 'Padding', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'	=> [
					'top'		=> '9',
					'right'	=> '0',
					'bottom' => '8',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_space_bottom',
			[
				'label'	=> esc_html__( 'Space Bottom', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_countDown_width',
			[
				'label'	=> esc_html__( 'Countdown Wrapper Width', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 90,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-countdown-clock' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// end ./ countdown clock

		/*
			-------------------------
			content style
			-------------------------
		*/ 
		$this->start_controls_section (
			'shopengine_product_content_style',
			[
				'label'	=> esc_html__( 'Content Style', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_content_title_clr',
			[
				'label'	=> esc_html__( 'Title Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#3E3E3E',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__desc--name a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_product_content_title_hover_clr',
			[
				'label'	=> esc_html__( 'Title Hover Color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#F03D3F',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__desc--name a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_content_title_typography',
				'label'    => esc_html__('Title typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-deal-products-widget .deal-products__desc--name a',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line-height'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '15',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_content_title_margin',
			[
				'label'=> esc_html__( 'Title margin', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units'=> ['px'],
				'default'	=> [
					'top'		=> '25',
					'right'	=> '0',
					'bottom' => '15',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__desc--name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_content_prices_margin',
			[
				'label'=> esc_html__( 'Price row margin', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units'=> ['px'],
				'default'	=> [
					'top'		=> '0',
					'right'	=> '0',
					'bottom' => '-8',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__prices' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);

		$this->add_control(
			'shopengine_product_content_reg_price_clr',
			[
				'label'	=> esc_html__( 'Regular price color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#ADADAD',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__prices del .amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_content_reg_price_typography',
				'label'    => esc_html__('Regular price typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-deal-products-widget .deal-products__prices del .amount',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height'],

				'fields_options'	=> [
					'typography' 	=> [
						'default'	=> 'custom',
					],
					'font_weight'	=> [
						'default' 	=> '600',
					],
					'font_size'   => [
						'label'    => esc_html__('Font Size (px)', 'shopengine'),
						'default'  => [
							'size'  => '13',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_content_sell_price_clr',
			[
				'label'	=> esc_html__( 'Sale price color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__prices ins .amount' => 'color: {{VALUE}}',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_content_sell_price_typography',
				'label'    => esc_html__('Sale price typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-deal-products-widget .deal-products__prices ins .amount',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height'],

				'fields_options'	=> [
					'typography' 	=> [
						'default' 	=> 'custom',
					],
					'font_weight'=> [
						'default' => '700',
					],
					'font_size'   => [
						'label'    => esc_html__('Font Size (px)', 'shopengine'),
						'default'  => [
							'size'  => '18',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->end_controls_section();

		/*
			-------------------------
			stock style
			-------------------------
		*/ 
		$this->start_controls_section (
			'shopengine_product_stock_style',
			[
				'label'	=> esc_html__( 'Stock and Progress Bar', 'shopengine' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_stock_text_clr',
			[
				'label'	=> esc_html__( 'Text color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#858585',
				'selectors' => [
					'{{WRAPPER}} .shopengine-deal-products-widget .deal-products__grap__sells span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_stock_text_typography',
				'label'    => esc_html__('Text typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-deal-products-widget .deal-products__grap__sells > div',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'     => [
						'label'     => esc_html__('Font Size (px)', 'shopengine'),
						'default'   => [
							'size'  => '13',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
					'line_height'     => [
						'label'     => esc_html__('Line-height (px)', 'shopengine'),
						'default'   => [
							'size'  => '14',
							'unit'  => 'px'
						],
						'responsive' => false,
						'size_units' => ['px']
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_stock_line_cap',
			[
				 'label' => esc_html__('Line Cap Style', 'shopengine'),
				 'type' => Controls_Manager::SELECT,
				 'default'   => esc_html__('round', 'shopengine'),
				 'options'   => [
					  'round'   => esc_html__('Round', 'shopengine'),
					  'square'  => esc_html__('Square', 'shopengine'),
				 ],
				 'separator'	=> 'after',
			]
	  	);

		$this->add_control(
			'shopengine_product_stock_bg_line_clr',
			[
				'label'	=> esc_html__( 'Normal line color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#F2F2F2',
			]
		);

		$this->add_control(
			'shopengine_product_stock_bg_line_height',
			[
				'label'	=> esc_html__( 'Normal line height', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'separator'	=> 'after',
			]
		);

		$this->add_control(
			'shopengine_product_stock_prog_line_clr',
			[
				'label'	=> esc_html__( 'Active line color', 'shopengine' ),
				'type'	=> Controls_Manager::COLOR,
				'alpha'	=> false,
				'default'=> '#F03D3F',
			]
		);

		$this->add_control(
			'shopengine_product_stock_prog_line_height',
			[
				'label'	=> esc_html__( 'Active line height', 'shopengine' ),
				'type'	=> Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shopengine_product_stock_typography',
			array(
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_product_stock_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-countdown-clock .se-clock-item,
					{{WRAPPER}} .shopengine-deal-products-widget .deal-products__desc--name a,
					{{WRAPPER}} .shopengine-deal-products-widget .deal-products__prices .amount,
					{{WRAPPER}} .shopengine-deal-products-widget .deal-products__grap__sells,
					{{WRAPPER}} .shopengine-deal-products-widget .shopengine-sale-badge,
					{{WRAPPER}} .shopengine-deal-products-widget .shopengine-offer-badge' => 'font-family: {{VALUE}}',
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
