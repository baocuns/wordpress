<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;


class ShopEngine_Product_Excerpt extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Excerpt_Config();
	}


	protected function register_controls() {

		/*
		 * Content Tab - Product Excerpt
		 */
		$this->start_controls_section(
			'shopengine_section_excerpt',
			[
				'label' => esc_html__('Styles', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_excerpt_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#444444',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-excerpt, {{WRAPPER}} .shopengine-product-excerpt p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_excerpt_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-excerpt, {{WRAPPER}} .shopengine-product-excerpt p',
				'exclude'        => ['text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '400',
					],
					'font_size'      => [
						'default'    => [
							'size' => '17',
							'unit' => 'px'
						],
						'label'      => 'Font size (px)',
						'size_units' => ['px'],
					],
					'line_height'    => [
						'default'    => [
							'size' => '22',
							'unit' => 'px'
						],
						'label'      => 'Line-height (px)',
						'size_units' => ['px']
					],
					'letter_spacing' => [
						'responsive' => false,
					]
				],
			)
		);

		$this->add_control(
			'shopengine_excerpt_align',
			[
				'label'     => esc_html__('Align', 'shopengine'),
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
					]
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-excerpt' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function screen() {

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
