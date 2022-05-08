<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Core\Template_Cpt;
use ShopEngine\Widgets\Products;

class ShopEngine_Product_Title extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Title_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_product_title_style',
			array(
				'label' => esc_html__('Product Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_product_title_header_size',
			[
				'label'     => esc_html__('HTML Tag', 'shopengine'),
				'type'      => Controls_Manager::SELECT,
				'description' => esc_html__("The H1 tag is important for SEO, accessibility and usability, so ideally, you should have one on each page of your site. A H1 tag should describe what the content of the given page is all about", 'shopengine'),
				'options'   => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'Div',
					'span' => 'Span',
					'p'    => 'P',
				],
				'default'   => 'h1',
				'selectors' => [
					'{{WRAPPER}} .product-title' => 'margin: 0; padding: 0;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_title_align',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf()
		);

		$this->add_control(
			'shopengine_product_title_product_title_color',
			[
				'label'     => esc_html__('Title Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .product-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_product_title_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .product-title',
				'exclude'        => ['text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '700',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default' => [
							'size' => '24',
							'unit' => 'px'
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '24',
							'unit' => 'px'
						],
						'size_units' => ['px'],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
					],
					'letter_spacing' => [
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'default' => [
							'size' => '0.1',
						],
						'size_units' => ['px'],
					],
				],
			)
		);

		$this->end_controls_section();

	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();

		$product = Products::instance()->get_product($post_type);

		echo sprintf(
			'<div class="shopengine-product-title"><%1$s class="product-title">%2$s</%1$s></div>',
			$settings['shopengine_product_title_header_size'],
			get_the_title($product->get_id())
		);
	}
}
