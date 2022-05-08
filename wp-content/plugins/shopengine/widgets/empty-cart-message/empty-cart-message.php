<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Empty_Cart_Message extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Empty_Cart_Message_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_empty_cart_message_style',
			[
				'label' => esc_html__('Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_empty_cart_message_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#3a3a3a',
				'selectors' => [
					'{{WRAPPER}} .shopengine-empty-cart-message .cart-empty, {{WRAPPER}} .shopengine-empty-cart-message .cart-empty::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_empty_cart_message_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#f5f5f5',
				'selectors' => [
					'{{WRAPPER}} .shopengine-empty-cart-message .cart-empty' => 'min-height:auto;border-radius:0; background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_empty_cart_message_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-empty-cart-message .cart-empty',
				'exclude'		 => ['font_style', 'text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'size_units' => ['px'],
						'default' => [
							'size' => '16',
							'unit' => 'px',
						],
					],
				
					'line_height'    => [
						'size_units' => ['px'],
						'default' => [
							'size' => '22',
							'unit' => 'px',
						],
					]
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_title_alignment',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'description' => esc_html__('Left', 'shopengine'),
						'icon'        => 'eicon-text-align-left',
					],
					'center' => [
						'description' => esc_html__('Center', 'shopengine'),
						'icon'        => 'eicon-text-align-center',
					],
					'right'  => [
						'description' => esc_html__('Right', 'shopengine'),
						'icon'        => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-empty-cart-message .cart-empty' => 'text-align: {{VALUE}} !important;',
				]
			]
		);

		$this->add_control(
			'shopengine_empty_cart_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '20',
					'bottom'   => '10',
					'left'     => '20',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-empty-cart-message .cart-empty' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
