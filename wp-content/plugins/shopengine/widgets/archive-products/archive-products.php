<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;


class ShopEngine_Archive_Products extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Archive_Products_Config();
	}


	protected function register_controls() {
		/*
            ===============================
            Layout Panel
            ===============================
        */
		$this->start_controls_section(
			'shopengine_section_layout',
			[
				'label' => esc_html__('Layout', 'shopengine'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'shopengine_layout_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__('you can manage the number of columns and rows from woocommerce customizer(product catalog)', 'shopengine'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);


		$this->end_controls_section(); // end ./ Layout Panel

		/*
			============================
			Content Panel
			============================
		*/

		$this->start_controls_section(
			'shopengine_section_content',
			[
				'label' => esc_html__('Content', 'shopengine'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'shopengine_show_sale_flash',
			[
				'label'        => esc_html__('Flash Sale Badge', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-archive-products .product .onsale' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'shopengine_is_cats',
			[
				'label'        => esc_html__('Show Categories', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'shopengine_is_details',
			[
				'label'        => esc_html__('Show Description', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'shopengine_archive_product_show_rating',
			[
				'label'        => esc_html__('Rating', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-archive-products :is(.shopengine-product-rating-review-count, .star-rating) ' => 'display: inline-flex;',
				],
			]
		);

		$this->add_control(
			'shopengine_show_regular_price',
			[
				'label'        => esc_html__('Show Regular Price', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => [
					'{{WRAPPER}} .shopengine-archive-products .product .price del' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'shopengine_show_off_tag',
			[
				'label'     => esc_html__('Show Off Price Tag', 'shopengine'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Show', 'shopengine'),
				'label_off' => esc_html__('Hide', 'shopengine'),
				'default'   => 'yes',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .price .shopengine-discount-badge' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'shopengine_group_btns',
			[
				'label'     => esc_html__('Button Group', 'shopengine'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Show', 'shopengine'),
				'label_off' => esc_html__('Hide', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_is_hover_details',
			[
				'label'        => esc_html__('Footer on Hover Style', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->end_controls_section(); // end ./ Content Panel

		/*
			===============================
			pagination settings
			===============================
		*/

		$this->start_controls_section(
			'shopengine_pagination_settings',
			[
				'label' => esc_html__('Pagination', 'shopengine'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'shopengine_pagination_style',
			[
				'label'   => esc_html__('Pagination Style', 'shopengine'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'numeric',
				'options' => [
					'numeric'             => esc_html__('Numeric', 'shopengine'),
					'default'             => esc_html__('Default', 'shopengine'),
					'load-more'           => esc_html__('Load More', 'shopengine'),
					'load-more-on-scroll' => esc_html__('Load More On Scroll', 'shopengine'),
				],
			]
		);


		$this->add_control(
			'shopengine_pagination_prev_icon',
			[
				'label'     => esc_html__('Previous Icon', 'shopengine'),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'eicon-chevron-left',
					'library' => 'eicons',
				],
				'condition' => [
					'shopengine_pagination_style' => 'numeric',
				],
			]
		);

		$this->add_control(
			'shopengine_pagination_next_icon',
			[
				'label'     => esc_html__('Next Icon', 'shopengine'),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'eicon-chevron-right',
					'library' => 'eicons',
				],
				'condition' => [
					'shopengine_pagination_style' => 'numeric',
				],
			]
		);

		$this->add_control(
			'shopengine_pagination_prev_text',
			[
				'label'       => esc_html__('Previous button', 'shopengine'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Previous', 'shopengine'),
				'placeholder' => esc_html__('Enter previous button text', 'shopengine'),
				'condition'   => [
					'shopengine_pagination_style' => 'default',
				],
			]
		);

		$this->add_control(
			'shopengine_pagination_next_text',
			[
				'label'       => esc_html__('Next button', 'shopengine'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Next', 'shopengine'),
				'placeholder' => esc_html__('Enter Next button text', 'shopengine'),
				'condition'   => [
					'shopengine_pagination_style' => 'default',
				],
			]
		);

		$this->add_control(
			'shopengine_pagination_loadmore_text',
			[
				'label'       => esc_html__('Load more button text', 'shopengine'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Load More', 'shopengine'),
				'placeholder' => esc_html__('Enter load more button text', 'shopengine'),
				'label_block' => true,
				'conditions'  => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'shopengine_pagination_style',
							'operator' => '==',
							'value'    => 'load-more',
						],
						[
							'name'     => 'shopengine_pagination_style',
							'operator' => '==',
							'value'    => 'load-more-on-scroll',
						],
					],
				],
			]
		);

		$this->end_controls_section(); // end ./ Content Panel

		/*
			===============================
			Custom Ordering settings
			===============================
		*/

		$this->start_controls_section(
			'shopengine_custom_ordering_settings',
			[
				'label' => esc_html__('Custom Ordering', 'shopengine'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

        $this->add_control(
            'shopengine_add_to_cart_data_ordering_enable',
            [
                'label'        => esc_html__('Enable Ordering?', 'shopengine'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'shopengine'),
                'label_off'    => esc_html__('No', 'shopengine'),
                'default'      => "yes",
                'return_value' => "yes",
                'selectors'    => [
                    '{{WRAPPER}} .shopengine-archive-products.shopengine-hover-disable .products .product' => 'display: flex; flex-direction: row; flex-wrap: wrap; align-items: center !important;',
                    '{{WRAPPER}} .shopengine-archive-products.shopengine-hover-disable .products .product a.woocommerce-LoopProduct-link' => 'width: 100%; order: -99;',
                    '{{WRAPPER}} .shopengine-archive-products .shopengine-product-description-btn-group' => 'display: flex; flex-direction: row; flex-wrap: wrap; align-items: center !important;',
                ],
            ]
        );
		
		$default = [
			[
				'list_title' => esc_html__( 'Quick View', 'shopengine' ),
				'list_key' => 'quick-view',
			],
			[
				'list_title' => esc_html__( 'Wishlist', 'shopengine' ),
				'list_key' => 'wishlist',
			],
			[
				'list_title' => esc_html__( 'Add to Cart', 'shopengine' ),
				'list_key' => 'add-to-cart',
			],
			[
				'list_title' => esc_html__( 'Comparison', 'shopengine' ),
				'list_key' => 'comparison',
			],
		];
		
		$repeater = new Repeater();
		$this->add_control(
			'shopengine_custom_ordering_list',
			[
				'label' => esc_html__( 'Ordering List', 'shopengine' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => $default,
				'title_field' => '{{{ list_title }}}',
				'item_actions' => [
					'add'       => false,
					'duplicate' => false,
					'remove'    => false,
					'sort'      => true,
				],
				'condition' => [
					'shopengine_add_to_cart_data_ordering_enable' => 'yes',
				]
			]
		);
		$this->end_controls_section(); // end ./ Content Panel


		/*
            ---------------------------------
            Container controls
            ---------------------------------
		 */
		$this->start_controls_section(
			'shopengine_section_container_styles',
			[
				'label' => esc_html__('Product Container', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_container_text_align',
			[
				'label'                => esc_html__('Alignment', 'shopengine'),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
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
				'default'              => 'left',
				'selectors_dictionary' => [
					'left'   => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;text-align:left;',
					'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;text-align:center;',
					'right'  => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;text-align:right;',
				],
				'selectors'            => [
					'{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .product > a' => '{{VALUE}}',
					'{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .shopengine-product-description-btn-group' => '{{VALUE}}',
					'{{WRAPPER}} .shopengine-archive-products.shopengine-hover-disable .products .product' => '{{VALUE}}',
					'.rtl {{WRAPPER}}.elementor-align-left a.woocommerce-LoopProduct-link' => 'text-align:right;',
					'.rtl {{WRAPPER}}.elementor-align-right a.woocommerce-LoopProduct-link' => 'text-align:left;',
				],
				'prefix_class'         => 'elementor%s-align-',
				'separator'            => 'after',
			]
		);

		$this->add_control(
			'shopengine_background',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .archive-product-container'                                        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-products .archive-product-container .shopengine-product-description-footer' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine__border',
				'selector'       => '{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .archive-product-container',
				'fields_options' => [
					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'responsive' => true,
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_margin',
			[
				'label'     => esc_html__('Product Gap', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 20,
				],

				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products.shopengine-grid ul.products' => 'grid-gap: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'shopengine_container_shadow_on_hover',
				'label'          => esc_html__('Box Shadow on hover', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .archive-product-container:hover',
				'fields_options' => [
					'box_shadow' => [
						'default' => [
							'horizontal' => 5,
							'vertical'   => 30,
							'blur'       => 35,
							'spread'     => 0,
							'color'      => 'rgba(0,0,0,0.16)',
						],
					],

				],
			]
		);

		$this->add_responsive_control(
			'shopengine_archive_products_container_row_spacing',
			[
				'label'      => esc_html__('Row Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .products .archive-product-container' => 'margin-bottom: {{SIZE}}px;',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .archive-product-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section();

		/*
            =============================
            Product Image section
            =============================
        */
		$this->start_controls_section(
			'shopengine_section_style_img',
			[
				'label' => esc_html__('Product Image', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'shopengine_image_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product .attachment-woocommerce_thumbnail' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_image_height_switch',
			[
				'label'        => esc_html__('Use image height', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_responsive_control(
			'shopengine_image_height',
			[
				'label'      => esc_html__('Height', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 600,
						'step' => 5,
					],
				],
				'default'    => [
					'size' => 255,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product .attachment-woocommerce_thumbnail' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => ['shopengine_image_height_switch' => 'yes'],
			]
		);

		$this->add_responsive_control(
			'shopengine_image_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product .attachment-woocommerce_thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section();

		/*
			=============================
			Product Category style
			=============================
		*/
		$this->start_controls_section(
			'shopengine_section_style_cats',
			[
				'label'     => esc_html__('Product Categories', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_is_cats' => 'yes',
				],
			]
		);
		$this->add_control(
			'shopengine_cats_max',
			[
				'label'     => esc_html__('Max Categories', 'shopengine'),
				'type'      => Controls_Manager::NUMBER,
				'separator' => 'after',
				'default'   => 1,
			]
		);

		$this->add_control(
			'shopengine_cats_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#858585',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product-categories' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_cats_font',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-products .product-categories > li',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '13',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'      => esc_html__('Line-height (px)', 'shopengine'),
						'default'    => [
							'size' => '14',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);


		$this->add_control(
			'shopengine_cats_spacing',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '15',
					'right'    => '0',
					'bottom'   => '5',
					'left'     => '0',
					'isLinked' => false,
					'unit'     => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product-categories' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section();

		/*
			=============================
			product title start
			=============================
		*/

		$this->start_controls_section(
			'shopengine_section_style_title',
			[
				'label' => esc_html__('Product Title', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_title_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .product .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'shopengine_title_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'shopengine' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .product a:hover .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_title_color_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) ul.products li.product .woocommerce-loop-product__title',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'] // enable only px
					],
				],
			]
		);


		$this->add_responsive_control(
			'shopengine_title_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products:not(.shopengine-archive-products--view-list) .product .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section();

		/*
			=============================
			product price start
			=============================
		*/
		$this->start_controls_section(
			'shopengine_section_style_price',
			[
				'label' => esc_html__('Product Price', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'shopengine_sell_price_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_price_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-products .product .price .amount',
				'exclude'        => ['font_family', 'text_transform', 'font_style', 'text_decoration', 'letter_spacing'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '700',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '22',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_price_reg_head',
			[
				'label'     => esc_html__('Regular Price', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'shopengine_show_regular_price' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_price_reg_pos',
			[
				'label'        => esc_html__('Position', 'shopengine'),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'before' => esc_html__('Before', 'shopengine'),
					'after'  => esc_html__('After', 'shopengine'),
				],
				'default'      => 'before',
				'prefix_class' => 'shopengine-price-pos-',
				'condition'    => [
					'shopengine_show_regular_price' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_price_reg_size',
			[
				'label'      => esc_html__('Font Size (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .price > del bdi' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_show_regular_price' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_price_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		/*
			=====================================
			Product Description
			=====================================
		*/

		$this->start_controls_section(
			'shopengine_product_description',
			[
				'label'     => esc_html__('Product Description', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_is_details' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_archive_description_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product .shopengine-product-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_archive_description_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-archive-products .product .shopengine-product-excerpt',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height'],
				'fields_options' => [
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'size_units' => ['px'],
						'responsive' => false,
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_archive_description_border',
				'selector'       => '{{WRAPPER}} .shopengine-archive-products .product .shopengine-product-excerpt',
				'fields_options' => [
					'border'  => [
						'default' => 'solid',
					],
					'width' => [
						'label'	  => esc_html__('Border Width', 'shopengine'),
						'default' => [
							'top'	   => '1',
							'right'	   => '0',
							'bottom'   => '0',
							'left'	   => '0',
							'isLinked' => false,
						],
					],
					'color' => [
						'label'	  => esc_html__('Border Color', 'shopengine'),
						'default' => '#f2f2f2',
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_archive_description_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product .shopengine-product-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
			=====================================
			Product Footer
			=====================================
		*/

		$this->start_controls_section(
			'shopengine_product_footer',
			[
				'label'     => esc_html__('Product Footer', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_is_hover_details' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_archive_footer_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product .shopengine-product-description-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
			----------------------------
			Off tag
			----------------------------
		*/

		$this->start_controls_section(
			'shopengine_off_tag',
			[
				'label'     => esc_html__('Off Tag', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_off_tag' => 'yes',
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
					'{{WRAPPER}}  .shopengine-discount-badge' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .shopengine-discount-badge' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .shopengine-discount-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .shopengine-discount-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// end off tag
		/*
		   ==============================
		   Button settings
		   ==============================
		*/

		$this->start_controls_section(
			'shopengine_section_button',
			[
				'label' => esc_html__('Add To Cart Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shopengine_archvie_btn_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '9',
					'right'    => '21',
					'bottom'   => '10',
					'left'     => '21',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_archvie_btn_margin',
			[
				'label'      => esc_html__('Margin', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_archvie_btn_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_archvie_btn_typography',
				'label'    => esc_html__('Button Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger)',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height'],
				'fields_options' => [
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'shopengine_archvie_btn_box_shadow',
				'label'    => esc_html__('Box Shadow', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-archive-products .product .button[data-quantity]',
			]
		);


		$this->start_controls_tabs('shopengine_archvie_btn_tabs');

		$this->start_controls_tab(
			'shopengine_archvie_btn_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_archvie_btn_normal_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f1f1f1',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger)' => 'text-align:left;color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_archvie_btn_normal_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#505255',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger)' => 'background: {{VALUE}}  !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_archvie_btn_tabs_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_archvie_btn_hover_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#f1f1f1',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger):hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_archvie_btn_hover_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger):hover' => 'background: {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section(); // end ./ Button settings

		/*
			==============================
			product rating
			==============================
		 */
		$this->start_controls_section(
			'shopengine_section_rating',
			[
				'label'     => esc_html__('Rating', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_archive_product_show_rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_product_start_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEC42D',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product .star-rating' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_start_size',
			[
				'label'     => esc_html__('Font Size (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 11,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .product .star-rating, {{WRAPPER}} .shopengine-product-rating-review-count' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_rating_gap',
			[
				'label'     => esc_html__('Star Gap (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .star-rating' => 'letter-spacing: {{SIZE}}{{UNIT}}; width: calc(5.4em + (4 * {{SIZE}}{{UNIT}}));',
					'.rtl {{WRAPPER}} .shopengine-archive-products .star-rating' => 'letter-spacing: {{SIZE}}{{UNIT}}; width: calc(5.4em + ({{SIZE}} * {{SIZE}}{{UNIT}}));',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_star_padding',
			[
				'label'      => esc_html__('Margin', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .product .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section(); // end ./ product rating


		/*
			==============================
			Sale Fash
			==============================
		 */
		$this->start_controls_section(
			'shopengine_section_sale_flash',
			[
				'label'     => esc_html__('Flash Sale', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_show_sale_flash' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_sale_flash_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_sale_flash_bg_color',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#4285F4',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_sale_flash_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-archive-products .onsale',
				'exclude'        => ['font_family', 'font_style', 'letter_spacing', 'line_height', 'text_decoration'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '500',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
				],
			]
		);


		$this->add_control(
			'shopengine_use_fixed_size',
			[
				'label'        => esc_html__('Use padding', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'shopengine_sale_flash_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['%', 'px'],
				'default'    => [
					'top'      => '50',
					'right'    => '50',
					'bottom'   => '50',
					'left'     => '50',
					'unit'     => '%',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_sale_flash_paddng',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'condition'  => ['shopengine_use_fixed_size' => 'yes'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => 'line-height:initial; min-height:auto; min-width:auto; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_sale_flash_sizee',
			[
				'label'      => esc_html__('Size', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition'  => ['shopengine_use_fixed_size' => ''],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => 'min-width:auto; min-height:auto;padding:0; text-align:center; line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Position
		$this->add_control(
			'shopengine_sale_flash_pos',
			[
				'label'     => esc_html__('Position', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'  => [
						'title' => esc_html__('Left', 'shopengine'),
						'icon'  => 'eicon-chevron-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'shopengine'),
						'icon'  => 'eicon-chevron-right',
					],
				],
				'default'   => 'left',
				'toggle'    => false,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_sale_flash_position_horizontial',
			[
				'label'      => esc_html__('Horizontal', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'		 => [
					'px' => [
						'max' => 400,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => '{{shopengine_sale_flash_pos.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_sale_flash_position_vertical',
			[
				'label'      => esc_html__('Vertical', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'		 => [
					'px' => [
						'max' => 400,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .onsale' => 'top:  {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // end ./  Flash Sale

		/*
			----------------------------
			Button group
			----------------------------
		*/


		$this->start_controls_section(
			'shopengine_section_button_group',
			[
				'label'     => esc_html__('Button group', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_group_btns' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_group_btns_over_image',
			[
				'label'        => esc_html__('Show Full Image On Mobile', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'no',
				'prefix_class' => 'shopengine-disable-group-btn-over-image-',
			]
		);

		$this->add_control(
			'shopengine_button_group_btn_bg_clr',
			[
				'label'     => esc_html__('Background color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner :is(a, button, .button)'       => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner :is(a, button, .button):hover' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner'                               => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_button_group_btn_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner a:not(.shopengine-wishlist) :is(i, span, svg, path, a::before)' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner .shopengine-wishlist path'                                      => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner a.button:not(.shopengine-quickview-trigger)::before'            => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_button_group_btn_hover_active_clr',
			[
				'label'     => esc_html__('Hover and Active Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner a:not(.shopengine-wishlist):hover :is(i, span, svg, path, a::before)' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner .shopengine-wishlist:hover path'                                      => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner a.button:hover:not(.shopengine-quickview-trigger)::before'            => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',

					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner a.active:not(.shopengine-wishlist) :is(i, span, svg, path, a::before)' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner .shopengine-wishlist.active path'                                      => 'fill:{{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner a.button.active:not(.shopengine-quickview-trigger)::before'            => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_button_group_btn_icon_size',
			[
				'label'      => esc_html__('Icon size', 'shopengine'),
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
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner :is(svg)'        => 'width: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .shopengine-widget .shopengine-archive-products .loop-product--btns :is(a, i)::before' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_button_group_btn_padding',
			[
				'label'      => esc_html__('Padding', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '15',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products ul li .loop-product--btns .loop-product--btns-inner :is(a:not(.wc-forward), button, .button)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section();
		// end button group
		/**
		 * Section: Pagination
		 */
		$this->start_controls_section(
			'shopengine_section_style_pagination',
			[
				'label' => esc_html__('Pagination', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'shopengine_pagi_align',
			[
				'label'                => esc_html__('Alignment', 'shopengine'),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
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
				'selectors_dictionary' => [
					'left'   => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;',
					'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;',
					'right'  => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;',
				],
				'selectors'            => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul' => '{{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_pagi_font',
				'label'    => esc_html__('Typography', 'shopengine'),
				'exclude'  => ['font_family', 'line_height', 'text_transform', 'text_decoration', 'text_transform', 'letter_spacing'],
				'selector' => '{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination',
				'fields_options' => [
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '16',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'responsive' => false,
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_pagi_top_space',
			[
				'label'      => esc_html__('Top Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('shopengine_pagi_tabs');
		$this->start_controls_tab(
			'shopengine_pagi_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);
		$this->add_control(
			'shopengine_pagi_n_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_pagi_n_bgcolor',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers:not(.dots)' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'shopengine_pagi_n_bd',
				'label'    => esc_html__('Border', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers:not(.dots)',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_pagi_tab_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);
		$this->add_control(
			'shopengine_pagi_h_color',
			[
				'label'     => esc_html__('Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers.current' => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_pagi_h_bgcolor',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers:not(.dots).current' => 'background: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers:not(.dots):hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_pagi_h_bdc',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers.current' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'shopengine_pagi_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_pagi_mg',
			[
				'label'      => esc_html__('Margin (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_pagi_pd',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination > ul > li > .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; min-width: 0;',
				],
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
				'shopengine_archive_products_font_family',
				[
					'label'       => esc_html__('Font Family', 'shopengine'),
					'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
					'type'        => Controls_Manager::FONT,
					'selectors'   => [
						'{{WRAPPER}} .shopengine-archive-products .product-categories > li,
						{{WRAPPER}} .shopengine-archive-products .product .woocommerce-loop-product__title,
						{{WRAPPER}} .shopengine-archive-products .product .price .amount,
						{{WRAPPER}} .shopengine-archive-products .product a.button:not(.shopengine-quickview-trigger),
						{{WRAPPER}} .shopengine-archive-products .onsale,
						{{WRAPPER}} .shopengine-archive-products .woocommerce-pagination,
						{{WRAPPER}} .shopengine-archive-products .product .shopengine-product-excerpt' => 'font-family: {{VALUE}};',
					],
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Product Action Buttons
	 */
	public function show_product_action_btns() {

		$data_attr = apply_filters('shopengine/group_btns/optional_tooltip_data_attr', '');

		woocommerce_template_loop_product_link_close();
		?>
        <div class="loop-product--btns" <?php echo esc_attr($data_attr)?>>
            <div class="loop-product--btns-inner">
				<?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>
		<?php
		woocommerce_template_loop_product_link_open();
	}

	/**
	 * Empty Product Rating
	 */
	public function show_empty_product_rating($html, $ratings, $count) {
		if('0' === $ratings):
			$html = '<div class="star-rating"></div>';
		endif;

		global $product;

		$review_count = $product->get_review_count();

		return $html . '<span class="shopengine-product-rating-review-count">(' . $review_count . ')</span>';
	}

	/**
	 * Product Categories
	 */
	public function show_product_cats() {
		$settings = $this->get_settings_for_display();
		$terms = get_the_terms(get_the_ID(), 'product_cat');

		if(empty($terms)) {
			return false;
		}

		$terms_count = count($terms);

		if($terms_count > 0) {
			echo '<ul class="product-categories">';
			foreach($terms as $key => $term) {
				if($settings['shopengine_cats_max'] === $key) {
					break;
				}

				echo '<li><span>' . esc_html($term->name) . '</span></li>';
			}
			echo '</ul>';
		}
	}

	private function generate_order_item_css($order_items) {
		$styles = '';
		$parent_class = '.elementor-element-' . $this->get_id();

		foreach($order_items as $key => $item) {
			$order_number = $key + 1;
			if($item['list_key'] == 'add-to-cart') {
				$styles .= $parent_class . ' .shopengine-archive-products a.add_to_cart_button  {order: '. $order_number .';}';
				$styles .= $parent_class . ' .shopengine-archive-products a.product_type_variable  {order: '. $order_number .';}';
				$styles .= $parent_class . ' .shopengine-archive-products a.product_type_grouped  {order: '. $order_number .';}';
				$styles .= $parent_class . ' .shopengine-archive-products a.product_type_external  {order: '. $order_number .';}'; // this line added by mizan@xpeedstudo.com
			}
			if($item['list_key'] == 'wishlist') {
				$styles .= $parent_class . ' .shopengine-archive-products .shopengine-wishlist  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'comparison') {
				$styles .= $parent_class . ' .shopengine-archive-products .shopengine-comparison  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'quick-view') {
				$styles .= $parent_class . ' .shopengine-archive-products .shopengine-quickview-trigger  {order: '. $order_number .';}';
			}
		}

		echo '<style>'.$styles.'</style>';
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();
		extract($settings);

		if(!empty($shopengine_custom_ordering_list)) {
			$this->generate_order_item_css($shopengine_custom_ordering_list);
		}

		$post_type = get_post_type();

		if(WC()->session && function_exists('wc_print_notices')) {
			wc_print_notices();
		} 


		/**
		 * Show Action Buttons
		 */
		if($shopengine_group_btns === 'yes') {
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

			add_filter('woocommerce_before_shop_loop_item_title', [$this, 'show_product_action_btns']);
		}


		/**
		 * Show Categories
		 */
		if($shopengine_is_cats === 'yes') {
			add_filter('woocommerce_before_shop_loop_item_title', [$this, 'show_product_cats']);
		}

		/**
		 * Show Empty Rating
		 */
		add_filter('woocommerce_product_get_rating_html', [$this, 'show_empty_product_rating'], 99, 3);


		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;


		/**
		 * Reset Filters to Default.
		 */
		if($shopengine_group_btns === 'yes') {
			remove_filter('woocommerce_before_shop_loop_item_title', [$this, 'show_product_action_btns']);

			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		}

		if($shopengine_is_cats === 'yes') {
			remove_filter('woocommerce_before_shop_loop_item_title', [$this, 'show_product_cats']);
		}

		remove_filter('woocommerce_product_get_rating_html', [$this, 'show_empty_product_rating'], 99);
	}
}
