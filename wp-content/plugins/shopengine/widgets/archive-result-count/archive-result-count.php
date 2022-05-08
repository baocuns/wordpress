<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Archive_Result_Count extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Archive_Result_Count_Config();
	}

	protected function register_controls() {
		$this->start_controls_section(
			'shopengine_result_count_section',
			[
				'label' => esc_html__('Result Count', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'shopengine_result_count_align',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf()
		);

		$this->add_control(
			'shopengine_result_count_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-result-count > p' => 'display:inline-block;color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_result_count_font',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-result-count > p',
				'exclude'        => ['letter_spacing', 'text_style', 'font_style', 'text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '400',
					],
					'font_size'      => [
						'size_units' => ['px'],
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],

					],
					'text_transform' => [
						'default' => '',
					],
					'line_height'    => [
						'size_units' => ['px'],
						'default'    => [
							'size' => '20',
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
