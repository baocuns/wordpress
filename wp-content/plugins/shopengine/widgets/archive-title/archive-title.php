<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Archive_Title extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Archive_Title_Config();
	}

	protected function register_controls() {

		$this->start_controls_section(
			'shopengine_section_archive_title_style',
			array(
				'label' => esc_html__('Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_archive_title_header_size',
			[
				'label'     => esc_html__('HTML Tag', 'shopengine'),
				'type'      => Controls_Manager::SELECT,
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
					'{{WRAPPER}} .archive-title' => 'margin: 0; padding: 0;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_archive_title_align',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf()
		);

		$this->add_control(
			'shopengine_archive_title_archive_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .archive-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_archive_title_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .archive-title',
				'exclude'        => ['font_style', 'text_decoration', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '700',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '24',
							'unit' => 'px'
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],

					'line_height' => [
						'size_units' => ['px'],
						'label'		 => 'Line-height (px)',
					]

				],
			)
		);

		$this->end_controls_section();

	}

	protected function screen() {

		$settings = $this->get_settings_for_display();
		$options_heading_title_tag = array_keys(
			[
				'h1'   => 'H1',
				'h2'   => 'H2',
				'h3'   => 'H3',
				'h4'   => 'H4',
				'h5'   => 'H5',
				'h6'   => 'H6',
				'div'  => 'div',
				'span' => 'span',
				'p'    => 'p',
			]
		);
		$title_tag = \ShopEngine\Utils\Helper::esc_options($settings['shopengine_archive_title_header_size'], $options_heading_title_tag, 'h2');

		echo sprintf(
			'<div class="shopengine-archive-title"><%1$s class="archive-title">%2$s</%1$s></div>',
			$title_tag,
			esc_html(woocommerce_page_title(false))
		);

	}
}
