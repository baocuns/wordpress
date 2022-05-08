<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Archive_View_Mode extends \ShopEngine\Base\Widget
{

	const SELECTOR_PREFIX = '.shopengine-archive-products.shopengine-archive-products--view-list ';

	public function config() {
		return new ShopEngine_Archive_View_Mode_Config();
	}

	protected function register_controls() {
		$this->start_controls_section(
			'shopengine_section_style',
			[
				'label' => esc_html__('View Mode Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_view_mode_icon_size',
			[
				'label'      => esc_html__('Icon Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_view_mode_icon_box_size',
			[
				'label'      => esc_html__('Icon Box Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => [
					'unit' => 'px',
					'size' => 52,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_view_mode_alignment',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'   => [
						'description' => esc_html__('Left', 'shopengine'),
						'icon'        => 'eicon-text-align-left',
					],
					'center' => [
						'description' => esc_html__('Center', 'shopengine'),
						'icon'        => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'description' => esc_html__('Right', 'shopengine'),
						'icon'        => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list' => 'justify-content: {{VALUE}};',
				]
			]
		);

		$this->start_controls_tabs('shopengine_view_mode_tabs_style');

		$this->start_controls_tab(
			'shopengine_view_mode_tabnormal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_view_mode_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a7a7a7',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_view_mode_background',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_view_mode_tabhover',
			[
				'label' => esc_html__('Hover & Active', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_view_mode_color_hover',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch:hover'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch.isactive' => 'color: {{VALUE}};',
				],
				'default'   => '#ff3f00',
			]
		);

		$this->add_control(
			'shopengine_view_mode_background_hover',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch:hover'    => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch.isactive' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_view_mode_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch:hover'	=> 'border-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch.isactive'	=> 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_view_mode_border',
				'label'          => esc_html__('Border', 'shopengine'),
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
						'default' => '#f2f2f2'
					]
				],
				'selector'       => '{{WRAPPER}} .shopengine-archive-view-mode .shopengine-archive-view-mode-switch-list .shopengine-archive-view-mode-switch',
				'separator'	=> 'before'
			]
		);

		$this->end_controls_section();

		/**
		 * 
		 * 
		 * 
		 * Product Layout: List View Image style
		 * 
		 * 
		 */ 
		$this->start_controls_section(
			'shopengine_product_layout',
			[
				'label' => esc_html__('List View: Image Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_product_layout_gap',
			[
				'label'      => esc_html__('Image gap from conent', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => [
					'unit' => 'px',
					'size' => 60,
				],

				'selectors'  => [
					self::SELECTOR_PREFIX . '.shopengine-archive-mode-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_image_width',
			[
				'label'      => esc_html__('Image Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 800,
					),
				),
				'default'    => [
					'unit' => 'px',
					'size' => 400,
				],

				'selectors'  => [
					self::SELECTOR_PREFIX . '.shopengine-archive-products__left-image img' => 'width: {{SIZE}}{{UNIT}} !important; min-width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_image_height',
			[
				'label'      => esc_html__('Image Height', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 800,
					),
				),
				'default'    => [
					'unit' => 'px',
					'size' => 400,
				],

				'selectors'  => [
					self::SELECTOR_PREFIX . '.shopengine-archive-products__left-image img' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_image_fit',
			[
				'label'   => esc_html__('Image Fit', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover'    => esc_html__('Cover', 'shopengine'),
					'contain'  => esc_html__('Contain', 'shopengine'),
					'fill'     => esc_html__('Fill', 'shopengine')
				],
				'selectors' => [
					self::SELECTOR_PREFIX . '.shopengine-archive-products__left-image img' => 'object-fit: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_image_position',
			[
				'label'   => esc_html__('Image View Position', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'top'     => esc_html__('Top', 'shopengine'),
					'center'  => esc_html__('Center', 'shopengine'),
					'bottom'  => esc_html__('Bottom', 'shopengine')
				],
				'selectors'  => [
					self::SELECTOR_PREFIX . '.shopengine-archive-products__left-image img' => 'object-position: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section(); // end of Product Layout: List View

		/**
		 * 
		 * 
		 * 
		 * List View Content Style
		 * 
		 * 
		 */ 
		$this->start_controls_section(
			'shopengine_product_content',
			[
				'label' => esc_html__('List View: Content Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_product_content_gap',
			[
				'label'      => esc_html__('Content gap from buttons', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => [
					'unit' => 'px',
					'size' => 25,
				],

				'selectors'  => [
					self::SELECTOR_PREFIX . '.woocommerce-LoopProduct-link' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_content_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					self::SELECTOR_PREFIX . '.product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section(); // end of List View Content Style


		/*
			=============================
			product title start
			=============================
		*/

		$this->start_controls_section(
			'shopengine_section_style_title',
			[
				'label' => esc_html__('List View : Product Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_title_color_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => self::SELECTOR_PREFIX . 'ul.products li.product .woocommerce-loop-product__title',
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
							'size' => '16',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'size_units' => ['px'] // enable only px
					],
				],
			]
		);


		$this->add_responsive_control(
			'shopengine_title_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					self::SELECTOR_PREFIX . '.product .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section(); // end of product title
	}

	protected function screen() {
		$settings = $this->get_settings_for_display();

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
