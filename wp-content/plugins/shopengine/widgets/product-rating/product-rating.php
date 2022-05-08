<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Product_Rating extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Rating_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_rating_section_style',
			array(
				'label' => esc_html__('Rating', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_rating_star_head',
			[
				'label' => esc_html__('Rating Star', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'shopengine_rating_star_color',
			[
				'label'     => esc_html__('Star Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEC42D',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating'							=> 'line-height: 0;',
					'{{WRAPPER}} .shopengine-product-rating .star-rating'				=> 'margin: 0; color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-product-rating .star-rating span::before'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_rating_empty_star_color',
			[
				'label'     => esc_html__('Empty Star Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d3ced2',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating .star-rating::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_rating_star_size',
			[
				'label'      => esc_html__('Star Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'shopengine_review_link_head',
			[
				'label'     => esc_html__('Review Link', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_rating_link_color',
			[
				'label'     => esc_html__('Link Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666666',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating a'                        => 'color: {{VALUE}}',
					'{{WRAPPER}} .shopengine-product-rating .woocommerce-review-link' => 'float: left;',
				],
			]
		);

		$this->add_control(
			'shopengine_rating_link_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_rating_text_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-rating a',
				'exclude'  => ['letter_spacing', 'font_style', 'text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_family'    => [
						'default' => '',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '13',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => '',
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '16',
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
					'letter_spacing' => [
						'default' => [
							'size' => '',
						]
					],
				],
			)
		);

		$this->add_control(
			'shopengine_rating_space_between',
			[
				'label'      => esc_html__('Left Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'body:not(.rtl) {{WRAPPER}} .shopengine-product-rating .star-rating' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .shopengine-product-rating .star-rating'       => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_rating_alignment',
			[
				'label'        => esc_html__('Alignment', 'shopengine'),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => esc_html__('Left', 'shopengine'),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__('Center', 'shopengine'),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__('Right', 'shopengine'),
						'icon'  => 'eicon-text-align-right',
					]
				],
				'prefix_class' => 'elementor%s-align-',
				'default'      => 'left',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-rating .woocommerce-product-rating' => 'display: inline-block; margin: 0;',
				],
				'separator'    => 'before',
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
