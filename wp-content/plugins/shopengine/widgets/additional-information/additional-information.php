<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Additional_Information extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Additional_Information_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_product_additional_information_common',
			array(
				'label' => esc_html__('Common', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);


		$this->add_responsive_control(
			'shopengine_product_additional_information_table_cell_padding',
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
					'{{WRAPPER}} .shopengine-additional-information tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-additional-information tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_product_additional_information_label_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-additional-information tr :is(td, th, p) ',
				'exclude'        => ['text_transform', 'text_decoration', 'line_height', 'text_style', 'letter_spacing'],
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
						'default' => 'capitalize',
					],
					'font_style'     => [
						'default' => 'normal',
					],
					'line_height'    => [
						'default' => [
							'size' => '19',
							'unit' => 'px',
						],
					],
					'letter_spacing' => [
						'default' => [
							'size' => '0',
						],
					],
				],
			)
		);

		$this->add_control(
			'shopengine_product_additional_information_separator_color',
			[
				'label'     => esc_html__('Separator Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-additional-information .shop_attributes tr:not(:last-child),
					{{WRAPPER}} .shopengine-additional-information table.shop_attributes tr td,
					{{WRAPPER}} .shopengine-additional-information table.shop_attributes tr th' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'shopengine_section_product_additional_information_label',
			array(
				'label' => esc_html__('Label', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_product_additional_information_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888888',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-additional-information tr th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_additional_information_label_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8f8f8',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-additional-information tr th' => 'background: {{VALUE}};',
				],
			]
		);

		

		$this->add_responsive_control(
			'shopengine_product_additional_information_label_width',
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
					'{{WRAPPER}} .shopengine-additional-information tr th' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shopengine_section_product_additional_information_value',
			array(
				'label' => esc_html__('Value', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_product_additional_information_value_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-additional-information tr td p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_additional_information_value_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fdfdfd',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-additional-information tr td' => 'background: {{VALUE}};',
				],
			]
		);

		

		$this->end_controls_section();



	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();

		$product = Products::instance()->get_product($post_type);

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
