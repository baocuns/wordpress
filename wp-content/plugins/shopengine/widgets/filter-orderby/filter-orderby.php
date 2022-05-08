<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Filter_OrderBy extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Filter_OrderBy_Config();
	}

	protected function register_controls() {
		/**
		 * Section: OrderBy Filter
		 */
		$this->start_controls_section(
			'shopengine_section_filter_orderby',
			[
				'label' => esc_html__('Order By Filter', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_orderby_type',
			[
				'label'   => esc_html__('Order By Filter Type', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'dropdown' => esc_html__('Dropdown', 'shopengine'),
					'list'     => esc_html__('List', 'shopengine'),
				],
				'default' => 'dropdown',
			]
		);

		$this->add_control(
			'shopengine_orderby_height',
			[
				'label'     => esc_html__('Height (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'   => [
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_orderby_font',
				'selector' => '{{WRAPPER}} .shopengine-filter-orderby, {{WRAPPER}} .shopengine-filter-orderby .orderby',
			]
		);

		$this->start_controls_tabs(
			'shopengine_tab_colors'
		);
		$this->start_controls_tab(
			'shopengine_tab_colors_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);
		$this->add_control(
			'shopengine_orderby_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-filter-orderby' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_orderby_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby'             => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-filter-orderby .orderby-input-group' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_orderby_border',
				'selector' => '{{WRAPPER}} .shopengine-filter-orderby .orderby, {{WRAPPER}} .shopengine-filter-orderby:after, {{WRAPPER}} .shopengine-filter-orderby .orderby-input-group',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_tab_colors_hover',
			[
				'label' => esc_html__('Hover & Checked', 'shopengine'),
			]
		);
		$this->add_control(
			'shopengine_orderby_hover_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby:hover'           => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-filter-orderby .orderby:hover + label'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-filter-orderby .orderby:checked + label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_orderby_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby:hover'             => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-filter-orderby .orderby-input-group:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_orderby_hover_border',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby:hover, {{WRAPPER}} .shopengine-filter-orderby:hover:after, {{WRAPPER}} .shopengine-filter-orderby .orderby-input-group:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'shopengine_orderby_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby'             => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-filter-orderby .orderby-input-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_orderby_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-filter-orderby .orderby'             => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-filter-orderby .orderby-input-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function screen() {
		$settings = $this->get_settings_for_display();

		// todo: later repeater options for the select values.
		$catalog_orderby_options = [
			'menu_order' => esc_html__('Default sorting', 'shopengine'),
			'popularity' => esc_html__('Sort by popularity', 'shopengine'),
			'rating'     => esc_html__('Sort by average rating', 'shopengine'),
			'date'       => esc_html__('Sort by latest', 'shopengine'),
			'price'      => esc_html__('Sort by price: low to high', 'shopengine'),
			'price-desc' => esc_html__('Sort by price: high to low', 'shopengine'),
			'title'      => esc_html__('Sort by title: a to z', 'shopengine'),
			'title-desc' => esc_html__('Sort by title: z to a', 'shopengine'),
		];

		$orderby = get_query_var('orderby');
		$edit_screen = in_array($orderby, array_keys($catalog_orderby_options)) ? $orderby : 'menu_order'; // Validate OrderBy default value.

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
