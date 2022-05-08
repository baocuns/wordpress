<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Product_Tags extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Tags_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_product_tags',
			array(
				'label' => esc_html__('Tags', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'shopengine_product_tags_align',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf()
		);

		$this->add_control(
			'shopengine_heading_product_tags_label',
			[
				'label'     => esc_html__('Tags Label', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tags_label_show',
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
			'shopengine_product_tags_label_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-tags .product-tags-label' => 'color: {{VALUE}};',
				],
				'condition' => [
					'shopengine_product_tags_label_show!' => '',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tags_text_decoration',
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
					'{{WRAPPER}} .shopengine-tags .product-tags-label' => 'text-decoration: {{VALUE}} !important; text-underline-offset: 3px;',
				],
				'condition' => [
					'shopengine_product_tags_label_show!' => '',
				],
			]
		);

		$this->add_control(
			'shopengine_heading_product_tags_links',
			[
				'label'     => esc_html__('Tags Links', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_tags_links_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#A0A0A0',
				'selectors' => [
					'{{WRAPPER}} .shopengine-tags .product-tags-links, {{WRAPPER}} .shopengine-tags .product-tags-links a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tags_links_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'selectors' => [
					'{{WRAPPER}} .shopengine-tags .product-tags-links a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_tags_typography',
			[
				'label'     => esc_html__('Global Typography', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_tags_links_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-tags, {{WRAPPER}} .shopengine-tags .product-tags-label, {{WRAPPER}} .shopengine-tags .product-tags-links a',
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
