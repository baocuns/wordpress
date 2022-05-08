<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;


class ShopEngine_Product_Sku extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Product_Sku_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_product_sku',
			array(
				'label' => esc_html__('SKU', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'shopengine_product_sku_align',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf()
		);

		$this->add_control(
			'shopengine_heading_product_sku_label',
			[
				'label'     => esc_html__('SKU Label', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_sku_label_show',
			[
				'label'        => esc_html__('Show Label', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'shopengine_product_sku_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-sku .sku-label' => 'color: {{VALUE}};',
				],
				'condition' => [
					'shopengine_product_sku_label_show!' => '',
				]
			]
		);

		$this->add_control(
			'shopengine_product_cats_label_text_decoration',
			[
				'label'     => esc_html__('Text Decoration', 'shopengine'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options' => [
					'underline'		=> esc_html__( 'Underline', 'shopengine' ),
					'overline'		=> esc_html__( 'Overline', 'shopengine' ),
					'line-through'	=> esc_html__( 'Line Through', 'shopengine' ),
					'none'			=> esc_html__( 'None', 'shopengine' ),
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-sku .sku-label' => 'text-decoration: {{VALUE}} !important; text-underline-offset: 3px;',
				],
				'condition' => [
					'shopengine_product_sku_label_show!' => '',
				],
			]
		);

		$this->add_control(
			'shopengine_heading_product_sku_value',
			array(
				'label'     => esc_html__('SKU Value', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'shopengine_product_sku_value_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#A0A0A0',
				'selectors' => [
					'{{WRAPPER}} .shopengine-sku .sku-value' => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-sku p' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_sku_typography_heading',
			[
				'label'     => esc_html__('Global Typography', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_sku_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'description'	 => esc_html__('This typography is set for this specific widget.', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-sku .sku-label, {{WRAPPER}} .shopengine-sku .sku-value',
				'exclude'		 => ['letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_size'       => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'default'    => [
							'size' => '14',
							'unit' => 'px',
						],
					],
					'font_weight'     => [
						'default' => '500',
					],
					'text_transform'  => [
						'default' => 'none',
					],
					'text_decoration' => [
						'default' => 'none',
						'selectors' => [
							'{{WRAPPER}} .shopengine-sku .sku-label, {{WRAPPER}} .shopengine-sku .sku-value' => 'text-decoration: {{VALUE}}; text-underline-offset: 3px;',
						],
					],
					'line_height'     => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
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

		$this->end_controls_section();
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
