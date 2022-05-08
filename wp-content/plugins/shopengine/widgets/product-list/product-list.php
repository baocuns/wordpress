<?php

namespace Elementor;

use ShopEngine\Core\Elementor_Controls\Controls_Manager as ShopEngine_Controls_Manager;
use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Product_List extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Product_List_Config();
	}

	protected function register_controls() {

		// GENERAL - SECTION
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__('General', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'products_per_page',
			[
				'label'   => esc_html__('Products Per Page', 'shopengine'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 12,
			]
		);

		$this->add_control(
			'product_order',
			[
				'label'   => esc_html__('Order', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC'  => esc_html__('ASC', 'shopengine'),
					'DESC' => esc_html__('DESC', 'shopengine'),
				],
			]
		);

		$this->add_control(
			'product_orderby',
			[
				'label'   => esc_html__('Order By', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => $this->config()->product_order_by(),
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'           => esc_html__('Column', 'shopengine'),
				'type'            => Controls_Manager::NUMBER,
				'min'             => 1,
				'max'             => 12,
				'step'            => 1,
				'desktop_default' => 3,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
				'selectors'       => [
					'{{WRAPPER}} .shopengine-product-list .product-list-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
				],
			]
		);

		$this->add_control(
			'product_by',
			[
				'label'     => esc_html__('Product Query By', 'shopengine'),
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->config()->product_query_by(),
				'default'   => 'category',
				'seperator' => 'before',
			]
		);

		$this->add_control(
			'term_list',
			[
				'label'       => esc_html__('Select Categories', 'shopengine'),
				'type'        => ShopEngine_Controls_Manager::AJAXSELECT2,
				'options'     => 'ajaxselect2/product_cat',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'product_by' => 'category',
				],
			]
		);

		$this->add_control(
			'tag_lists',
			[
				'label'       => esc_html__('Select Tags', 'shopengine'),
				'type'        => ShopEngine_Controls_Manager::AJAXSELECT2,
				'options'     => 'ajaxselect2/product_tags',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'product_by' => 'tag',
				],
			]
		);

		$this->add_control(
			'product_list',
			[
				'label'       => esc_html__('Select Products', 'shopengine'),
				'type'        => ShopEngine_Controls_Manager::AJAXSELECT2,
				'options'     => 'ajaxselect2/product_list',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'product_by' => 'product',
				],
			]
		);

		$this->add_control(
			'rating_list',
			[
				'label'       => esc_html__('Select Rating', 'shopengine'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => [
					'1' => esc_html__('1 star', 'shopengine'),
					'2' => esc_html__('2 star', 'shopengine'),
					'3' => esc_html__('3 star', 'shopengine'),
					'4' => esc_html__('4 star', 'shopengine'),
					'5' => esc_html__('5 star', 'shopengine'),
				],
				'multiple'    => true,
				'label_block' => true,
				'default'     => [5],
				'condition'   => [
					'product_by' => 'rating',
				],
			]
		);

		$this->add_control(
			'pa_attribute_list',
			[
				'label'       => esc_html__('Select Attributes', 'shopengine'),
				'type'        => ShopEngine_Controls_Manager::AJAXSELECT2,
				'options'     => 'ajaxselect2/product_pa_list',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'product_by' => 'attribute',
				],
			]
		);

		$this->add_control(
			'author_list',
			[
				'label'       => esc_html__('Select Authors', 'shopengine'),
				'type'        => ShopEngine_Controls_Manager::AJAXSELECT2,
				'options'     => 'ajaxselect2/product_authors',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'product_by' => 'author',
				],
			]
		);

		$this->end_controls_section();

		// SETTINGS - SECTION
		$this->start_controls_section(
			'settings',
			[
				'label' => esc_html__('Settings', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		// SETTINGS - BADGE
		$this->add_control(
			'badge_settings',
			[
				'label'     => esc_html__('Badge', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_sale',
			[
				'label'        => esc_html__('Show Sale Badge?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .badge.sale' => 'display: inline-block !important;',
				],
			]
		);

		$this->add_control(
			'show_off',
			[
				'label'        => esc_html__('Show Discount Percentage', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .badge.off' => 'display: inline-block;',
				],
			]
		);

		$this->add_control(
			'show_tag',
			[
				'label'        => esc_html__('Show Tag', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .badge.tag' => 'display: inline-block;',
				],
			]
		);

		$this->add_control(
			'badge_position',
			[
				'label'      => esc_html__('Badge Position', 'shopengine'),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => [
					'top-left'  => [
						'title' => esc_html__('Top Left', 'shopengine'),
						'icon'  => 'eicon-h-align-left',
					],
					'top-right' => [
						'title' => esc_html__('Top Right', 'shopengine'),
						'icon'  => 'eicon-h-align-right',
					],
					'custom'    => [
						'title' => esc_html__('Custom', 'shopengine'),
						'icon'  => 'eicon-settings',
					],
				],
				'default'    => 'top-right',
				'toggle'     => false,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'show_sale',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_off',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_tag',
							'operator' => '===',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'badge_position_x_axis',
			[
				'label'      => esc_html__('Badge Position (X axis)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 4,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-tag-sale-badge' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'badge_position' => 'custom',
				],
			]
		);

		$this->add_control(
			'badge_position_y_axis',
			[
				'label'      => esc_html__('Badge Position (Y axis)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 4,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-tag-sale-badge' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'badge_position' => 'custom',
				],
			]
		);

		$this->add_control(
			'badge_align',
			[
				'label'      => esc_html__('Badge Align', 'shopengine'),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => [
					'vertical'   => [
						'title' => esc_html__('Vertical', 'shopengine'),
						'icon'  => 'eicon-navigation-vertical',
					],
					'horizontal' => [
						'title' => esc_html__('Horizontal', 'shopengine'),
						'icon'  => 'eicon-navigation-horizontal',
					],
				],
				'default'    => 'horizontal',
				'toggle'     => false,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'show_sale',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_off',
							'operator' => '===',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		// SETTINGS - TITLE
		$this->add_control(
			'title_settings',
			[
				'label'     => esc_html__('Title', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_character',
			[
				'label'        => esc_html__('Chracter to Show', 'shopengine'),
				'description'  => esc_html__('Chracter to show in the product title', 'shopengine'),
				'type'         => Controls_Manager::NUMBER,
				'return_value' => 'yes',
				'default'      => 30,
			]
		);

		// SETTINGS - HOVER
		$this->add_control(
			'product_hover_overlay_settings',
			[
				'label'     => esc_html__('Product Hover', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_product_hover_overlay',
			[
				'label'        => esc_html__('Show Product Hover', 'shopengine'),
				'description'  => esc_html__('Styling controls are in the style tab', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'default'      => 'yes',
				'return_value' => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-list .overlay-add-to-cart' => 'display: flex;',
				],
			]
		);

		$this->add_control(
			'product_hover_overlay_position',
			[
				'label'     => esc_html__('Position', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__('Left', 'shopengine'),
						'icon'  => 'eicon-h-align-left',
					],
					'right'  => [
						'title' => esc_html__('Right', 'shopengine'),
						'icon'  => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'shopengine'),
						'icon'  => 'eicon-v-align-bottom',
					],
					'center' => [
						'title' => esc_html__('Center', 'shopengine'),
						'icon'  => 'eicon-h-align-center',
					],
				],
				'default'   => 'bottom',
				'toggle'    => false,
				'condition' => [
					'show_product_hover_overlay' => 'yes',
				],
			]
		);

		// SETTINGS - PRICE
		$this->add_control(
			'price_settings',
			[
				'label'     => esc_html__('Price', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'price_alignment',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'flex-start',
				'options'   => [
					'flex-start'    => esc_html__('Start', 'shopengine'),
					'center'        => esc_html__('Center', 'shopengine'),
					'flex-end'      => esc_html__('End', 'shopengine'),
					'space-around'  => esc_html__('Space Around', 'shopengine'),
					'space-between' => esc_html__('Space Between', 'shopengine'),
					'space-evenly'  => esc_html__('Space Evenly', 'shopengine'),
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'show_off_price_tag',
			[
				'label'        => esc_html__('Show Off Tag', 'shopengine'),
				'description'  => esc_html__('Styling controls are in the style tab', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge' => 'display: inline-block;',
				],
			]
		);

		// SETTINGS - CATEGORY
		$this->add_control(
			'category_settings',
			[
				'label'     => esc_html__('Category', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'        => esc_html__('Show Category?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'shopengine'),
				'label_off'    => esc_html__('No', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-product-list .product-category' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'category_limit',
			[
				'label'     => esc_html__('Category Limit', 'shopengine'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		// SETTINGS - RATTING
		$this->add_control(
			'show_rating',
			[
				'label'       => esc_html__('Show Rating?', 'shopengine'),
				'description' => esc_html__('Styling controls are in the style tab', 'shopengine'),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__('Yes', 'shopengine'),
				'label_off'   => esc_html__('No', 'shopengine'),
				'default'     => 'yes',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-product-list .product-rating' => 'display: block;',
				],
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT WRAP
		$this->start_controls_section(
			'product_wrap_style_section',
			[
				'label' => esc_html__('Product Wrap', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'product_content_align',
			[
				'label'     => esc_html__('Content Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'description' => esc_html__('Left', 'shopengine'),
						'icon'        => 'eicon-text-align-left',
					],
					'center' => [
						'description' => esc_html__('Center', 'shopengine'),
						'icon'        => 'eicon-text-align-center',
					],
					'right'  => [
						'description' => esc_html__('Right', 'shopengine'),
						'icon'        => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_item_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-single-product-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_item_column_gap',
			[
				'label'      => esc_html__('Column Gap (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => '20',
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-list .product-list-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'product_item_row_gap',
			[
				'label'      => esc_html__('Row Gap (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => '20',
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-list .product-list-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'product_wrap_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '15',
					'right'    => '15',
					'bottom'   => '15',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-single-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'product_wrap_border',
				'label'     => esc_html__('Border', 'shopengine'),
				'selector'  => '{{WRAPPER}} .shopengine-single-product-item',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT IMAGE
		$this->start_controls_section(
			'product_image_style',
			[
				'label' => esc_html__('Product Image', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_image_bg',
			[
				'label'     => esc_html__('Image Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'product_image_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - 	PRODUCT BADGE
		$this->start_controls_section(
			'product_badge_style_section',
			[
				'label'      => esc_html__('Product Badge', 'shopengine'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'show_sale',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_off',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_tag',
							'operator' => '===',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'product_badge_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '700',
					],
					'font_size'   => [
						'default'    => [
							'size' => '12',
							'unit' => 'px',
						],
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'default'    => [
							'size' => '24',
							'unit' => 'px',
						],
						'size_units' => ['px'], // enable only px
						'responsive' => false,
					],
				],
			]
		);

		$this->add_control(
			'product_badge_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'product_badge_bg',
			[
				'label'     => esc_html__('Badge Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#f03d3f',
				'selectors' => [
					'{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'product_percentage_badge_bg',
			[
				'label'     => esc_html__('Percentage Badge Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-tag-sale-badge .off' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_off' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'product_badge_space_between',
			[
				'label'      => esc_html__('Space In-between Badge (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-tag-sale-badge ul li:not(:last-child)'                => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .product-tag-sale-badge.align-vertical ul li:not(:last-child)' => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_badge_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '10',
					'bottom'   => '0',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_badge_margin',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'badge_border',
				'label'     => esc_html__('Border', 'shopengine'),
				'selector'  => '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'    => '3',
					'right'  => '3',
					'bottom' => '3',
					'left'   => '3',
				],
				'selectors'  => [
					'{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT CATEGORY
		$this->start_controls_section(
			'product_category_style_section',
			[
				'label'     => esc_html__('Product Category', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'product_category_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .product-category ul li a',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default'    => [
							'size' => '13',
							'unit' => 'px',
						],
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'default'    => [
							'size' => '20',
							'unit' => 'px',
						],
						'size_units' => ['px'], // enable only px
						'responsive' => false,
					],
				],
				'separator'      => 'after',
			]
		);

		$this->start_controls_tabs(
			'product_category_tabs'
		);

		$this->start_controls_tab(
			'product_category_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'product_category_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#858585',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-category ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'product_category_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'product_category_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-category ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'product_category_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '5',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-category' => 'line-height: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT TITLE
		$this->start_controls_section(
			'product_title_style_section',
			[
				'label' => esc_html__('Product Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'product_title_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .product-title',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'size_units' => ['px'], // enable only px
						'responsive' => false,
					],
				],
			]
		);

		$this->start_controls_tabs(
			'product_title_color_tabs'
		);

		$this->start_controls_tab(
			'product_title_color_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'product_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'product_title_color_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'product_title_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'product_title_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '8',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-title' => 'margin: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT RATING
		$this->start_controls_section(
			'product_rating_style_section',
			[
				'label'     => esc_html__('Product Rating', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'product_rating_star_size',
			[
				'label'      => esc_html__('Rating Star Size', 'shopengine'),
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
					'size' => 12,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'product_rating_star_color',
			[
				'label'     => esc_html__('Star Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fec42d',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-rating .star-rating span::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_rating_empty_star_color',
			[
				'label'     => esc_html__('Empty Star Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fec42d',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-rating .star-rating::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_rating_count_color',
			[
				'label'     => esc_html__('Count Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .rating-count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'product_rating_count_typography',
				'label'          => esc_html__('Count Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .rating-count',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default'    => [
							'size' => '12',
							'unit' => 'px',
						],
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'default'    => [
							'size' => '12',
							'unit' => 'px',
						],
						'size_units' => ['px'], // enable only px
						'responsive' => false,
					],
				],
			]
		);

		$this->add_responsive_control(
			'product_rating_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-rating' => 'line-height: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT PRICE
		$this->start_controls_section(
			'product_price_style_section',
			[
				'label' => esc_html__('Product Price', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_price_price_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .product-price :is(.price, .amount, bdi)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_price_sale_price_color',
			[
				'label'     => esc_html__('Sale Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#999999',
				'selectors' => [
					'{{WRAPPER}} .product-price .price del' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'product_price_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .product-price .price',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '700',
					],
					'font_size'   => [
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
					],
					'line_height' => [
						'default'    => [
							'size' => '20',
							'unit' => 'px',
						],
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'size_units' => ['px'], // enable only px
						'responsive' => false,
					],
				],
			]
		);

		$this->add_control(
			'product_price_space_between',
			[
				'label'      => esc_html__('Space In-between Prices (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price ins' => 'margin-right: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_control(
			'product_price_discount_badge_style_section',
			[
				'label'     => esc_html__('Price Discount Badge', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_off_price_tag' => 'yes',
				],
			]
		);

		$this->add_control(
			'product_price_discount_badge_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_off_price_tag' => 'yes',
				],
			]
		);

		$this->add_control(
			'product_price_discount_badge_bg_color',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F54F29',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_off_price_tag' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'product_price_discount_badge_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'description'    => esc_html__('Typography for sale price and discount badge', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'text_decoration'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
						'label'   => esc_html__('Typography Sale and Discount', 'shopengine'),
					],
					'font_weight' => [
						'default' => '700',
					],
					'font_size'   => [
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
					],
					'line_height' => [
						'default'    => [
							'size' => '24',
							'unit' => 'px',
						],
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'size_units' => ['px'], // enable only px
						'responsive' => false,
					],
				],
			]
		);

		$this->add_responsive_control(
			'product_price_discount_badge_padding',
			[
				'label'      => esc_html__('Badge Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '10',
					'bottom'   => '0',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_off_price_tag' => 'yes',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_price_discount_badge_margin',
			[
				'label'      => esc_html__('Badge Margin', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '5',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_off_price_tag' => 'yes',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_price_wrap_padding',
			[
				'label'      => esc_html__('Wrap Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .product-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - PRODUCT HOVER
		$this->start_controls_section(
			'product_hover_overlay_style_section',
			[
				'label'     => esc_html__('Product Hover', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_product_hover_overlay' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'product_hover_overlay_color_tabs'
		);

		$this->start_controls_tab(
			'product_hover_overlay_color_normal_tab',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'product_hover_overlay_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .overlay-add-to-cart a::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .overlay-add-to-cart a::after'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_hover_overlay_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .overlay-add-to-cart a' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'product_hover_overlay_color_hover_tab',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'product_hover_overlay_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .overlay-add-to-cart a.active::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .overlay-add-to-cart a.added::before'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .overlay-add-to-cart a.loading::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .overlay-add-to-cart a:hover::before'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .overlay-add-to-cart a:hover::after'   => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_hover_overlay_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .overlay-add-to-cart a.active' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .overlay-add-to-cart a:hover'  => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .overlay-add-to-cart a:hover'  => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'product_hover_overlay_font_size',
			[
				'label'      => esc_html__('Font Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .overlay-add-to-cart a::before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart a::after'  => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_hover_overlay_padding',
			[
				'label'      => esc_html__('Item Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '22',
					'bottom'   => '10',
					'left'     => '22',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .overlay-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_hover_overlay_item_space_between',
			[
				'label'      => esc_html__('Space In-between Items (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .overlay-add-to-cart.position-bottom a:not(:last-child)'                  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-left a:not(:last-child)'                    => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-right a:not(:last-child)'                   => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-center a:not(:nth-child(2n))'               => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .overlay-add-to-cart.position-center a:not(:nth-child(1), :nth-child(2))' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'product_hover_overlay_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'fields_options' => [
					'border' => [
						'default'   => '',
						'selectors' => [
							'{{SELECTOR}} .overlay-add-to-cart'                    => 'border-style: {{VALUE}};',
							'{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-style: {{VALUE}};',
						],
					],
					'width'  => [
						'label'     => esc_html__('Border Width', 'shopengine'),
						'default'   => [
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '0',
							'left'     => '0',
							'isLinked' => true,
						],
						'selectors' => [
							'{{SELECTOR}} .overlay-add-to-cart'                    => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-width: 0 {{RIGHT}}{{UNIT}} 0 0;',
						],
					],
					'color'  => [
						'label'     => esc_html__('Border Color', 'shopengine'),
						'default'   => '#F2F2F2',
						'selectors' => [
							'{{SELECTOR}} .overlay-add-to-cart'                    => 'border-color: {{VALUE}};',
							'{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-color: {{VALUE}};',
						],
					],
				],
				'separator'      => 'before',
			]
		);

		$this->add_responsive_control(
			'product_hover_overlay_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .overlay-add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'product_hover_overlay_margin',
			[
				'label'      => esc_html__('Wrap Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .overlay-add-to-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();


		/**
		 * Section: Global Font
		 */
		$this->start_controls_section(
			'shopengine_section_style_global',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'shopengine_product_list_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'selectors'   => [
					'{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link,
                         {{WRAPPER}} .product-category ul li a,
                         {{WRAPPER}} .product-title,
                         {{WRAPPER}} .rating-count,
                         {{WRAPPER}} .product-price .price,
                         {{WRAPPER}} .shopengine-product-list .product-price .price .shopengine-discount-badge' => 'font-family: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		extract($settings);

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
