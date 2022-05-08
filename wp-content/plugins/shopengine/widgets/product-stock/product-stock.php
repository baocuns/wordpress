<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Product_Stock extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Stock_Config();
	}

	protected function stock_types() {
		return [
			'in_stock'               => esc_html__('In Stock', 'shopengine'),
			'out_of_stock'           => esc_html__('Out of Stock', 'shopengine'),
			'available_on_backorder' => esc_html__('Available on Backorder', 'shopengine'),
		];
	}


	protected function register_controls() {
		/**
		 * Section: Product Stock
		 */
		$this->start_controls_section(
			'shopengine_pstock_settings',
			[
				'label' => esc_html__('Product Stock', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shopengine_pstock_stock_type',
			[
				'label'   => esc_html__('Type', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->stock_types(),
				'default' => 'in_stock',
			]
		);

		$this->add_control(
			'shopengine_pstock_stock_warning',
			[
				'type'        		=> Controls_Manager::RAW_HTML,
				'raw'            	=> esc_html__('Note: This is just a demonstration of how a different stock will look in the frontend.', 'shopengine'),
				'content_classes'	=> 'elementor-panel-alert elementor-panel-alert-info',
				'separator'			=> 'after',
			]
		);

		$this->add_responsive_control(
			'shopengine_pstock_alignment',
			\ShopEngine\Utils\Controls_Helper::get_alignment_conf(
				'shopengine-stock-align-',
				'',
				[
					'{{WRAPPER}} .shopengine-product-stock' => 'text-align: {{VALUE}};',
				]
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'shopengine_pstock_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-stock p',
				'exclude'		 => ['text_decoration', 'letter_spacing'],
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
						'default' => [
							'size' => '14',
							'unit' => 'px'
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
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
			)
		);

		$this->end_controls_section();


		/**
		 * Section: In Stock
		 */
		$this->start_controls_section(
			'shopengine_pstock_in_stock_section',
			array(
				'label' => esc_html__('In Stock', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'shopengine_pstock_in_stock_icon',
			[
				'label'   => esc_html__('Icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-check-circle',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'shopengine_pstock_in_stock_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#169543',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-stock .in-stock' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * Section: Out of Stock
		 */
		$this->start_controls_section(
			'shopengine_pstock_out_of_stock_section',
			array(
				'label' => esc_html__('Out of Stock', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'shopengine_pstock_out_of_stock_icon',
			[
				'label'   => esc_html__('Icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-times-circle',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'shopengine_pstock_out_of_stock_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d9534f',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-stock .out-of-stock' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * Section: Available on Backorder
		 */
		$this->start_controls_section(
			'sshopengine_pstock_available_on_backorder_section',
			array(
				'label' => esc_html__('Available on Backorder', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'shopengine_pstock_available_on_backorder_icon',
			[
				'label'   => esc_html__('Icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-shopping-cart',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'shopengine_pstock_available_on_backorder_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ee9800',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-stock .available-on-backorder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function _get_product($p_type) {

		global $product;

		if($p_type == 'product') {
			$product = wc_get_product();
		} else {
			$product = '';
		}

		return $product;
	}

	public function _get_icon($icon) {

		if($icon) {
			ob_start();
			\Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
			$icon = ob_get_clean();
		} else {
			$icon = '';
		}

		return $icon;
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

		$settings = $this->get_settings_for_display();

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
