<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Product_Meta extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Meta_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_meta_content',
			[
				'label' => esc_html__('Settings', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shopengine_meta_sku_hide',
			[
				'label'        => esc_html__('SKU', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'default'      => "yes",
				'return_value' => "yes",
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-meta .sku_wrapper'								=> 'display: block;',
					'{{WRAPPER}}.shopengine-layout-inline .shopengine-product-meta .sku_wrapper'	=> 'display: inline-block;',
				],
			]
		);

		$this->add_control(
			'shopengine_meta_category_hide',
			[
				'label'        => esc_html__('Category', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'default'      => "yes",
				'return_value' => "yes",
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-meta .posted_in'							=> 'display: block;',
					'{{WRAPPER}}.shopengine-layout-inline .shopengine-product-meta .posted_in'	=> 'display: inline-block;',
					'{{WRAPPER}} .shopengine-product-meta .products-page-cats'        			=> 'display: block;', // xstore alignment & display issue fix
					'{{WRAPPER}}.shopengine-layout-inline .shopengine-product-meta  .products-page-cats'	=> 'display: inline-block;', // xstore alignment & display issue fix
				],
			]
		);

		$this->add_control(
			'shopengine_meta_tag_hide',
			[
				'label'        => esc_html__('Tag', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'default'      => "yes",
				'return_value' => "yes",
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-meta .tagged_as'							=> 'display: block;',
					'{{WRAPPER}}.shopengine-layout-inline .shopengine-product-meta .tagged_as'	=> 'display: inline-block;',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Styles Tab
		 */
		$this->start_controls_section(
			'shopengine_section_meta_style',
			[
				'label' => esc_html__('Styles', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_meta_layout',
			[
				'label'        => esc_html__('Layout', 'shopengine'),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'block',
				'options'      => [
					'block'  => [
						'title' => esc_html__('Default', 'shopengine'),
						'icon'  => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => esc_html__('Inline', 'shopengine'),
						'icon'  => 'eicon-ellipsis-h',
					],
				],
				'prefix_class' => 'shopengine-layout-',
			]
		);

		$this->add_responsive_control(
			'shopengine_meta_align',
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
					'{{WRAPPER}} .shopengine-product-meta .product_meta' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_meta_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
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
					'{{WRAPPER}} .shopengine-product-meta .product_meta :is(.sku_wrapper, .posted_in, .tagged_as)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_meta_label_heading',
			[
				'label'     => esc_html__('Label', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_meta_label_color',
			[
				'label'     => esc_html__('Label Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-meta .product_meta :is(.sku_wrapper, .posted_in, .tagged_as)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_meta_value_heading',
			[
				'label'     => esc_html__('Value', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_meta_value_color',
			[
				'label'     => esc_html__('Value Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a0a0a0',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-meta .product_meta :is(.sku, .posted_in a, .tagged_as a)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_meta_value_link_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-meta .product_meta :is(.posted_in a, .tagged_as a):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_meta_typography_heading',
			[
				'label'     => esc_html__('Global Typography', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_meta_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'description'	 => esc_html__('This typography is set for this specific widget.', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-meta .product_meta :is(a, span, .sku_wrapper, .posted_in, .tagged_as)',
				'exclude'        => ['text_decoration', 'font_style', 'letter_spacing'],
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

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
