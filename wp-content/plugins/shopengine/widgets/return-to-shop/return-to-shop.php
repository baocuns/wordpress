<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Return_To_Shop extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Return_To_Shop_Config();
	}


	protected function register_controls() {
		$this->start_controls_section(
			'shopengine_settings_section',
			[
				'label' => esc_html__('Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_button_align',
			[
				'label'     => esc_html__('Button Alignment', 'shopengine'),
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
					'{{WRAPPER}} .shopengine-return-to-shop .return-to-shop' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_typography_primary',
				'label'          => esc_html__('Typography', 'shopengine'),
				'exclude'        => ['letter_spacing','font_style', 'text_style', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
					],
					'line_height' => [
						'size_units' => ['px'],
						'label'		=> 'Line Height (px)',
						'responsive' => false,
					]
				],
				'selector'       => '{{WRAPPER}} .shopengine-return-to-shop .button',
			]
		);

		$this->start_controls_tabs('shopengine_button_tabs_style');

		$this->start_controls_tab(
			'shopengine_button_tabnormal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_button_text_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-return-to-shop .button' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_button_text_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-return-to-shop .button' => 'background-color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_input_border',
				'label'    => esc_html__('Border', 'shopengine'),
				'fields_options' => [
					'border'      => [
						'default'    => 'solid',
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-return-to-shop .button' => 'border-style: {{VALUE}} !important;',
						],
					],

					'width' => [
						'label'      => esc_html__('Border Width', 'shopengine'),
						'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1',
							'unit'   => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .shopengine-return-to-shop .button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						],
						'responsive' => false,
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-return-to-shop .button' => 'border-color: {{VALUE}} !important;',
						],
					],

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_button_tab_button_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_button_hover_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-return-to-shop .button:hover' => 'color: {{VALUE}}  !important;',
				],
			]
		);


		$this->add_control(
			'shopengine_button_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-return-to-shop .button:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_input_border_hover',
				'label'    => esc_html__('Border', 'shopengine'),
				'fields_options' => [
					'border'      => [
						'default'    => 'solid',
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-return-to-shop .button:hover' => 'border-style: {{VALUE}} !important;',
						],
					],

					'width' => [
						'label'      => esc_html__('Border Width', 'shopengine'),
						'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1',
							'unit'   => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .shopengine-return-to-shop .button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						],
						'responsive' => false,
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'responsive' => false,
						'selectors' => [
							'{{WRAPPER}} .shopengine-return-to-shop .button:hover' => 'border-color: {{VALUE}} !important;',
						],
					],

				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'shopengine_button_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'unit'     => 'px',
					'top'      => 3,
					'right'    => 3,
					'bottom'   => 3,
					'left'     => 3,
					'isLinked' => true
				],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .shopengine-return-to-shop .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_button_text_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '15',
					'right'    => '20',
					'bottom'   => '16',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-return-to-shop .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'shopengine_button_box_shadow_group',
				'selector' => '{{WRAPPER}} .shopengine-return-to-shop .button',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function screen() {

		if(wc_get_page_id('shop') > 0) {

			$tpl = Products::instance()->get_widget_template($this->get_name());

			include $tpl;
		}
	}
}