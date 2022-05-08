<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Up_Sells extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Up_Sells_Config();
	}

	protected function register_controls() {

		/*
		 * Content Tab
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_content_section',
			[
				'label' => esc_html__('Content', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_enable_slider',
			[
				'label'        => esc_html__('Enable Slider', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
				'description' => esc_html__('Slider dosen\'t work if up-sells products and products to show is smaller than or equal to slides per view.', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_show_flash_sale',
			[
				'label'        => esc_html__('Flash Sale', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .onsale' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_show_sale_price',
			[
				'label'        => esc_html__('Sale Price', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .price del' => 'display: inline-block;',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_show_cart_btn',
			[
				'label'        => esc_html__('Cart Button', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells  .button' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_to_show',
			[
				'label'			=> esc_html__('Products to Show', 'shopengine'),
				'description'	=> esc_html__('How many products want show in total.', 'shopengine'),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 50,
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_columns',
			[
				'label'	=> esc_html__('Columns', 'shopengine'),
				'description'	=> esc_html__('How many products want show per row.', 'shopengine'),
				'type'	=> Controls_Manager::NUMBER,
				'default'	=> 4,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'min'	=> 1,
				'max'	=> 12,
				'selectors'	=> [
					'{{WRAPPER}} .shopengine-up-sells ul.products' => 'display: grid; grid-template-columns: repeat({{SIZE}}, 1fr) !important;',
				],
				'condition'	=> [
					'shopengine_up_sells_product_enable_slider!' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Content Tab - Slider Controls
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_slider_controls_section',
			[
				'label'     => esc_html__('Slider Controls', 'shopengine'),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'shopengine_up_sells_product_enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_perview',
			[
				'label'       => esc_html__('Slides Per View', 'shopengine'),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 4,
				'min'         => 1,
				'max'         => 12,
				'description' => esc_html__('This value will be the number of slides to show in viewport.', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_loop',
			[
				'label'        => esc_html__('Loop', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_autoplay',
			[
				'label'        => esc_html__('Autoplay', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_autoplay_delay',
			[
				'label'     => esc_html__('Slide Speed', 'shopengine'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3000,
				'min'       => 0,
				'max'       => 10000,
				'condition' => [
					'shopengine_up_sells_product_slider_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_show_arrows',
			[
				'label'        => esc_html__('Show Arrows', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'label_on'     => esc_html__('Show', 'shopengine'),
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_show_dots',
			[
				'label'        => esc_html__('Show Dots', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'label_on'     => esc_html__('Show', 'shopengine'),
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);


		$this->add_control(
			'shopengine_up_sells_product_slider_left_arrow_icon',
			[
				'label'            => esc_html__('Left Arrow', 'shopengine'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-chevron-left',
					'library' => 'fa-solid',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_right_arrow_icon',
			[
				'label'            => esc_html__('Right Arrow', 'shopengine'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_dots_size',
			[
				'label'      => esc_html__('Dots Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_dots' => 'yes',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_dots_size_active',
			[
				'label'      => esc_html__('Active Dots Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_dots' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Content Tab -  Advanced Slider Controls
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_advance_controls',
			[
				'label' => esc_html__('Advanced', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_orderby',
			[
				'label'   => esc_html__('Order By', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'rand',
				'options' => [
					'date'       => esc_html__('Date', 'shopengine'),
					'title'      => esc_html__('Title', 'shopengine'),
					'price'      => esc_html__('Price', 'shopengine'),
					'popularity' => esc_html__('Popularity', 'shopengine'),
					'rating'     => esc_html__('Rating', 'shopengine'),
					'rand'       => esc_html__('Random', 'shopengine'),
					'menu_order' => esc_html__('Menu Order', 'shopengine'),
					'modified'   => esc_html__('Modified Date', 'shopengine'),
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_order',
			[
				'label'   => esc_html__('Order', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'desc' => esc_html__('DESC', 'shopengine'),
					'asc'  => esc_html__('ASC', 'shopengine'),
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Products Wrap
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_items_section',
			[
				'label' => esc_html__('Items', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_text_align',
			[
				'label'     => esc_html__('Text Align', 'shopengine'),
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
				'selectors_dictionary' => [
					'left'   => 'text-align: left; justify-content: flex-start;',
					'center' => 'text-align: center; justify-content: center;',
					'right'  => 'text-align: right; justify-content: flex-end;',
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.product, .price)' => '{{VALUE}}',
					'.rtl {{WRAPPER}}.elementor-align-left .shopengine-up-sells .up-sells :is(.product, .price)' => 'text-align:right;',  
					'.rtl {{WRAPPER}}.elementor-align-right .shopengine-up-sells .up-sells :is(.product, .price)' => 'text-align:left;'
				],
				'prefix_class'         => 'elementor%s-align-',
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_column_gap',
			[
				'label'   => esc_html__('Column Gap (px)', 'shopengine'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'   => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'		=> [
					'{{WRAPPER}} .shopengine-up-sells.slider-disabled ul.products'		=> 'grid-gap: {{SIZE}}{{UNIT}};',
					'.elementor-editor-active {{WRAPPER}} .shopengine-up-sells.slider-enabled ul.products > li'	=> 'margin-right: {{SIZE}}{{UNIT}} !important;',
				]
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_buttons',
			[
				'label'		=> esc_html__( 'Buttons', 'shopengine' ),
				'type'		=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_btns_space_between',
			[
				'label'   		=> esc_html__('Space In-between (px)', 'shopengine'),
				'type'    		=> Controls_Manager::SLIDER,
				'size_units'	=> ['px'],
				'range'			=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 50,
						'step'	=> 1,
					],
				],
				'default'		=> [
					'unit'	=> 'px',
					'size'	=> 10,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .products li a:not(.woocommerce-LoopProduct-link, :last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		/*
		 * Style Tab - Flash Sale
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_flash_sale',
			[
				'label'     => esc_html__('Flash Sale', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_up_sells_product_show_flash_sale' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_flash_sale_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .onsale' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_flash_sale_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4285f4',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .onsale' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_up_sells_product_flash_sale_badge_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-up-sells .onsale',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '400',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '12',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => '',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '44',
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
			'shopengine_up_sells_product_flash_sale_badge_size',
			[
				'label'   => esc_html__('Badge Size (px)', 'shopengine'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'   => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 44,
				],
				'selectors'		=> [
					'{{WRAPPER}} .shopengine-up-sells .onsale' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_flash_sale_badge_border_radius',
			[
				'label'   => esc_html__('Badge Border Radius (px)', 'shopengine'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'   => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'		=> [
					'{{WRAPPER}} .shopengine-up-sells .onsale' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_flash_sale_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_flash_sale_position',
			[
				'label'   => esc_html__('Position', 'shopengine'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'  => [
						'title' => esc_html__('Left', 'shopengine'),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'shopengine'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
                'separator'	=> 'before'
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_flash_sale_position_horizontal',
			[
				'label'      => esc_html__('Horizontal', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .onsale' => '{{shopengine_up_sells_product_flash_sale_position.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_flash_sale_position_vertical',
			[
				'label'      => esc_html__('Vertical', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .onsale' => 'top:  {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Products Image
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_image_section',
			[
				'label' => esc_html__('Image', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_image_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .product img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_image_height',
			[
				'label'			=> esc_html__('Height (px)', 'shopengine'),
				'description'	=> esc_html__('Leave empty for auto height', 'shopengine'),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> ['px'],
				'range'			=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 500,
						'step'	=> 5,
					],
				],
				'default'		=> [
					'size'	=> '',
				],
				'selectors'		=> [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .product img' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_related_image_auto_fit',
			[
				'label'        => esc_html__('Auto Image Fit', 'shopengine'),
				'type'      => Controls_Manager::SWITCHER,
				'default'      => false,
				'return_value' => true,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .product img' => 'object-fit: cover; object-position:center center',
				],
			]
		);


		$this->add_responsive_control(
			'shopengine_up_sells_product_image_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '8',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells .product img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Products Title
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_title_section',
			[
				'label' => esc_html__('Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_up_sells_product_title_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-up-sells .woocommerce-loop-product__title',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'size_units' => ['px'],
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
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_title_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '8',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Products Rating
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_rating_section',
			[
				'label' => esc_html__('Rating', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_rating_start_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fec42d',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .products .star-rating'			=> 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-up-sells .products .star-rating::before'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_rating_start_size',
			[
				'label'     => esc_html__('Star Size (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .products .product .star-rating' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_rating_start_margin_bottom',
			[
				'label'     => esc_html__('Margin Bottom (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .products .product .star-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Products Price
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_price_section',
			[
				'label' => esc_html__('Price', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_price_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.price, .price span, .price .amount)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_sale_price_color',
			[
				'label'     => esc_html__('Sale Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .price :is(del span, del .amount)' => 'color: {{VALUE}};',
				],
				'condition' => [
					'shopengine_up_sells_product_show_sale_price' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'         	=> 'shopengine_up_sells_product_price_typography',
				'selector'    	=> '{{WRAPPER}} .shopengine-up-sells :is(.price, .price .amount, .price ins, .price del)',
				'exclude'		=> ['text_transform', 'text_decoration', 'font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_weight'     => [
						'default' => '700',
					],
					'font_size'       => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'	=> [
							'size' => '18',
							'unit' => 'px'
						]
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '24',
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
			'shopengine_up_sells_product_price_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '8',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Products Rating
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_add_cart_btn_section',
			[
				'label' => esc_html__('Add To Cart', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_up_sells_product_show_cart_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_upsell_button_move_end',
			[
				'label'        => esc_html__('Position End', 'shopengine'),
				'type'      => Controls_Manager::SWITCHER,
				'default'      => false,
				'return_value' => true,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)' => 'order: 1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_up_sells_product_add_cart_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'default'    => [
							'size' => '13',
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
							'size' => '18',
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
				'separator'      => 'before',
			]
		);

		$this->start_controls_tabs(
			'shopengine_up_sells_product_add_cart_btn_style_tabs',
			[
                'separator'	=> 'before',
			]
		);

		$this->start_controls_tab(
			'shopengine_up_sells_product_add_cart_btn_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_add_cart_btn_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_add_cart_btn_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3E3E3E',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_up_sells_product_add_cart_btn_tab_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_add_cart_btn_hover_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_add_cart_btn_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#332d2d',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_add_cart_btn_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'shopengine_up_sells_product_add_cart_btn_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '8',
					'right'    => '15',
					'bottom'   => '8',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'shopengine_up_sells_product_add_cart_border',
				'label'     => esc_html__('Border', 'shopengine'),
				'selector'  => '{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)',
                'separator'	=> 'before',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_add_cart_border_radius',
			[
				'label'     => esc_html__('Border Radius (px)', 'shopengine'),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'   => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_add_cart_btn_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.button, .added_to_cart)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab -  Slider
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_slider_style_section',
			[
				'label' => esc_html__('Slider Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name'		=> 'shopengine_up_sells_product_enable_slider',
							'operator'	=> '===',
							'value'		=> 'yes'
						],
						[
							'relation'	=> 'or',
							'terms' => [
								[
									'name'		=> 'shopengine_up_sells_product_slider_show_arrows',
									'operator'	=> '===',
									'value'		=> 'yes'
								],
								[
									'name'		=> 'shopengine_up_sells_product_slider_show_dots',
									'operator'	=> '===',
									'value'		=> 'yes'
								]
							]
						]
					]
				]
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_style',
			[
				'label'		=> esc_html__( 'Arrows', 'shopengine' ),
				'type'		=> Controls_Manager::HEADING,
				'condition' => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrow_size',
			[
				'label'      => esc_html__('Arrow Size (px)', 'shopengine'),
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
					'size' => 40,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-next, .swiper-button-prev)' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrow_icon_size',
			[
				'label'      => esc_html__('Icon Size (px)', 'shopengine'),
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
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next)' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrow_position',
			[
				'label'      => esc_html__('Arrow Position (y-axis)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next)' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
				'separator'		=> 'before',
			]
		);

		$this->start_controls_tabs(
			'shopengine_up_sells_product_slider_arrows_tabs',
			[
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'shopengine_up_sells_product_slider_arrows_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3E3E3E',
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_up_sells_product_slider_arrows_tab_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#332d2d',
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'shopengine_up_sells_product_slider_arrows_border',
				'label'     => esc_html__('Border', 'shopengine'),
				'selector'  => '{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next)',
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
                'separator'	=> 'before',
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_arrows_border_radius',
			[
				'label'     => esc_html__('Border Radius (px)', 'shopengine'),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'   => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells :is(.swiper-button-prev, .swiper-button-next)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_up_sells_product_slider_show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_style_divider',
			[
				'type'		=> Controls_Manager::DIVIDER,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name'		=> 'shopengine_up_sells_product_slider_show_arrows',
							'operator'	=> '===',
							'value'		=> 'yes'
						],
						[
							'name'		=> 'shopengine_up_sells_product_slider_show_dots',
							'operator'	=> '===',
							'value'		=> 'yes'
						]
					]
				]
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_dots_style',
			[
				'label'		=> esc_html__( 'Dots', 'shopengine' ),
				'type'		=> Controls_Manager::HEADING,
				'condition' => [
					'shopengine_up_sells_product_slider_show_dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_dots_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c9c9c9',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'shopengine_up_sells_product_slider_show_dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_slider_active_dots_color',
			[
				'label'     => esc_html__('Active Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f03d3f',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-up-sells .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'$shopengine_up_sells_product_slider_show_dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_up_sells_product_slider_dot_wrap_margin',
			[
				'label'      => esc_html__('Wrap Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '20',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-up-sells .swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'$shopengine_up_sells_product_slider_show_dots' => 'yes',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
		 * Style Tab - Global Font
		 */
		$this->start_controls_section(
			'shopengine_up_sells_product_global_font_section',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_up_sells_product_global_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'selectors'   => [
					'{{WRAPPER}} .shopengine-up-sells .up-sells :is(.onsale, .woocommerce-loop-product__title, .price, del, ins, .button)' => 'font-family: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function get_icon_html($icon) {

		if($icon) {
			ob_start();
			\Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
			$icon = ob_get_clean();
		} else {
			$icon = '';
		}

		return $icon;
	}

	protected function screen() {
		$settings = $this->get_settings_for_display();

		echo \ShopEngine\Utils\Helper::render($this->view_render($settings));
	}

	protected function view_render($settings = []) {
		
		extract($settings);

		$post_type = get_post_type();

		$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);

		if(empty($product)) {
			return;
		}


		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
