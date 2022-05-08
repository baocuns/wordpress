<?php
namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Product_Description extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Description_Config();
	}


	protected function register_controls() {
		/*
		 * Content Tab - Product description
		 */
		$this->start_controls_section(
			'shopengine_section_description',
			[
				'label' => esc_html__('Styles', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_desc_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#444444',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_desc_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-description, {{WRAPPER}} .shopengine-product-description li',
				'exclude'        => ['text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default'    => [
							'size' => '17',
							'unit' => 'px'
						],
						'label'      => 'Font size (px)',
						'size_units' => ['px']
					],
					'line_height' => [
						'default'    => [
							'size' => '22',
							'unit' => 'px'
						],
						'size_units' => ['px']
					]
				],
			)
		);

		$this->add_responsive_control(
			'shopengine_desc_align',
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
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-description' => 'text-align: {{VALUE}}',
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

