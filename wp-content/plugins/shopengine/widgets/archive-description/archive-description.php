<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Archive_Description extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Archive_Description_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_archive_description_style',
			array(
				'label' => esc_html__('Description', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'shopengine_archive_description_align',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf()
		);

		$this->add_control(
			'shopengine_archive_description_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-description p' => 'color: {{VALUE}}; margin: 0;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_archive_description_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-description p',
				'exclude'        => ['letter_spacing', 'text_style', 'text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '400',
					],
					'font_size'      => [
						'default'    => [
							'size' => '16',
							'unit' => 'px'
						],
						'size_units' => ['px']

					],
					'text_transform' => [
						'default' => '',
					],
					'line_height'    => [
						'default' => [
							'size' => '20',
							'unit' => 'px'
						]
					],
					'letter_spacing' => [
						'default' => [
							'size' => '',
						]
					],
				],
			)
		);

		$this->end_controls_section();

	}

	protected function screen() {

		$post_type = get_post_type();

		$product = Products::instance()->get_product($post_type);

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
