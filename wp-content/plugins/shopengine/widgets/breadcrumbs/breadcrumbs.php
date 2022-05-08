<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;


class ShopEngine_Breadcrumbs extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Breadcrumbs_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_breadcrumbs_style',
			[
				'label' => esc_html__('Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_breadcrumbs_text_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-breadcrumbs :is( .woocommerce-breadcrumb, i )' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_breadcrumbs_link_color',
			[
				'label'     => esc_html__('Link Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#999999',
				'selectors' => [
					'{{WRAPPER}} .shopengine-breadcrumbs .woocommerce-breadcrumb a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_breadcrumbs_link_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-breadcrumbs .woocommerce-breadcrumb a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_breadcrumbs_text_typography',
				'selector'       => '{{WRAPPER}} .shopengine-breadcrumbs .woocommerce-breadcrumb',
				'exclude'		 => ['text_decoration', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
						'default'    => [
							'size' => '14',
							'unit' => 'px'
						],
						'label'      => 'Font size (px)',
						'size_units' => ['px'],
					],
					'font_weight'    => [
						'default' => '500',
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'line_height'    => [
						'default' => [
							'size' => '17',
							'unit' => 'px'
						]
					],
					'letter_spacing' => [
						'default' => [
							'size' => '0',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_breadcrumbs_alignment',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'	=> [
						'title'		=> esc_html__('Left', 'shopengine'),
						'icon'		=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title' 	=> esc_html__('Center', 'shopengine'),
						'icon'  	=> 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' 	=> esc_html__('Right', 'shopengine'),
						'icon'  	=> 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-breadcrumbs .woocommerce-breadcrumb' => 'justify-content: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'shopengine_breadcrumbs_icon',
			[
				'label'   => esc_html__('Icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'shopengine_breadcrumbs_icon_size',
			[
				'label'     => esc_html__('Icon Size (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'   => [
					'size' => 9,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-breadcrumbs i,
					{{WRAPPER}} .shopengine-breadcrumbs .divider,
					{{WRAPPER}} .shopengine-breadcrumbs .delimeter' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'shopengine_breadcrumbs_space_between',
			[
				'label'      => esc_html__('Space In-between', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 8,
					'unit' => 'px'
				],
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-breadcrumbs .woocommerce-breadcrumb i' => 'margin: 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-breadcrumbs .woocommerce-breadcrumb'   => 'margin: 0;',
				],
				'separator'  => 'before',
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
