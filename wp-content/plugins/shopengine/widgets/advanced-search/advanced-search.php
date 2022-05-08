<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Advanced_Search extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Advanced_Search_Config();
	}

	protected function register_controls() {

		/*
			------------------------------
			General settings
			------------------------------
		*/

		$this->start_controls_section(
			'shopengine_advanced_search_general',
			[
				'label' => esc_html__('General', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shopengine_advanced_search_product_column',
			[
				'label'          => esc_html__('Products Column', 'shopengine'),
				'type'           => Controls_Manager::SELECT,
				'default'        => '1',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => [
					'1' => 'Column 1',
					'2' => 'Column 2',
					'3' => 'Column 3',
					'4' => 'Column 4',
					'5' => 'Column 5',
				],
				'selectors'      => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);



		$this->add_control( 
			'shopengine_advanced_search_show_category_on_search_result',
			[
				'label'          => esc_html__('Show Category on search result?', 'shopengine'),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'block',
				'options'        => [
					'block' => 'Show',
					'none'  => 'Hide',
				],
				'selectors'      => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-category-name' => 'display: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control( // responsive control support bajaar theme.
			'shopengine_advanced_search_disable_category_btn',
			[
				'label'          => esc_html__('Show Category Dropdown', 'shopengine'),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'block',
				'tablet_default' => 'block',
				'mobile_default' => 'none',
				'options'        => [
					'block' => 'Show',
					'none'  => 'Hide',
				],
				'selectors'      => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-category-select-wraper' => 'display: {{VALUE}};',
				],
				'separator'      => 'before',
			]
		);

		$this->add_control(
			'shopengine_advanced_search_title_all',
			[
				'label'       => esc_html__('Text for All Categories', 'shopengine'),
				'description' => esc_html__('Add text for all categories options.', 'shopengine'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'All Categories',
				'condition'   => [
					'shopengine_advanced_search_disable_category_btn' => 'block',
				],
				'separator'   => 'after',
			]
		);
		$this->add_control(
			'shopengine_advanced_search_icon',
			[
				'label'   => esc_html__('Search icon', 'shopengine'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-search',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_add_search_text',
			[
				'label'        => esc_html__('Add Search Text?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'no',

			]
		);

		$this->add_control(
			'shopengine_is_image',
			[
				'label'        => esc_html__('Hide Image from Search?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'no',
				'default'      => 'no',
				'selectors'      => [
					'{{WRAPPER}} .shopengine-advanced-search :is(.shopengine-search-product__item--image)' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_text',
			[
				'label'       => esc_html__('Search Text', 'shopengine'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'condition'   => [
					'shopengine_advanced_add_search_text' => 'yes',
				],
				'separator'   => 'after',
				'description' => esc_html__('You can control the width from search icon style tab', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_advanced_search_order',
			[
				'label'        => esc_html__('Order Search Components?', 'shopengine'),
				'description'  => esc_html__('This is an advanced option to change the postion of the search components,', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$default = [
			[
				'list_title' => esc_html__( 'Search Box', 'shopengine' ),
				'list_key' => 'search-box',
			],
			[
				'list_title' => esc_html__( 'Search Input', 'shopengine' ),
				'list_key' => 'search-input',
			],
			[
				'list_title' => esc_html__( 'Category Selector', 'shopengine' ),
				'list_key' => 'category-selector',
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
					'shopengine_advanced_search_order' => 'yes',
				]
			]
		);
		$this->end_controls_section(); // end ./ general settings


		/*
			------------------------------
			search bar style
			------------------------------
		*/

		$this->start_controls_section(
			'shopengine_advanced_search_search_bar',
			[
				'label' => esc_html__('Search form', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control( // responsive control added for bajaar theme
			'shopengine_advanced_search_search_bar_height',
			[
				'label'      => esc_html__('Form Height (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
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
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is(  button, input, select )' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_search_form_radius',
			[
				'label'      => esc_html__('Form Radius', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_advanced_search_searchbar_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-advanced-search :is( .search-input-group )',
				'exclude'		=> ['color'],
				'fields_options' => [
					'border_type' => [
						'default' => 'yes',
					],
					'border'      => [
						'default'    => 'solid',
						'responsive' => true,
					],

					'width' => [
						'label'      => esc_html__('Border Width', 'shopengine'),
						'default'    => [
							'top'    => '2',
							'right'  => '2',
							'bottom' => '2',
							'left'   => '2',
							'unit'   => 'px',
						],
						'responsive' => true,
						'selectors'  => [
							'{{WRAPPER}} .shopengine-advanced-search :is( .search-input-group )' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'default'    => '#E6E6E6',
						'responsive' => false,
					],

				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_input_clr',
			[
				'label'     => esc_html__('Input Box Text Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3E3E3E',
				'separator' => 'before',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group input,
					{{WRAPPER}} .shopengine-advanced-search .search-input-group input::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shopengine_advanced_search_input_bg_clr',
			[
				'label'     => esc_html__('Input Box Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is(  input )' => 'background: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_advanced_search_input_typography',
				'label'          => esc_html__('Search Box Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-advanced-search .search-input-group :is( input, input::placeholder )',
				'exclude'        => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height'],
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
							'size' => '16',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);


		$this->end_controls_section(); // end ./ search bar style


		/*
		  ------------------------------
		  Search Icon style
		  ------------------------------
		 */

		$this->start_controls_section(
			'shopengine_advanced_search_search_icon_style',
			[
				'label'       => esc_html__('Search Icon / Text style', 'shopengine'),
				'tab'         => Controls_Manager::TAB_STYLE,
				'description' => esc_html__('You can control the width from search icon / text style option', 'shopengine'),
			]
		);
			$this->start_controls_tabs( 'tabs_button_style' );
				$this->start_controls_tab(
					'se_adv_search_btn_n',
					[
						'label' => esc_html__( 'Normal', 'shopengine' ),
					]
				);
					$this->add_control(
						'shopengine_advanced_search_btn_icon_clr',
						[
							'label'     => esc_html__('Search Button Text Color', 'shopengine'),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#3E3E3E',
							'alpha'     => false,
							'selectors' => [
								'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is(  button ) i, {{WRAPPER}} .shopengine-search-text' => 'color: {{VALUE}}',
							],
						]
					);
			
					$this->add_control(
						'shopengine_advanced_search_btn_bg_clr',
						[
							'label'     => esc_html__('Search Button Background Color', 'shopengine'),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#E6E6E6',
							'alpha'     => false,
							'selectors' => [
								'{{WRAPPER}} .shopengine-advanced-search :is( .search-input-group button, .search-input-group )' => 'background: {{VALUE}}; border-color:{{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'se_adv_search_btn_h',
					[
						'label' => esc_html__( 'Hover', 'shopengine' ),
					]
				);
					$this->add_control(
						'se_adv_search_btn_icon_color',
						[
							'label'     => esc_html__('Search Button Text Color', 'shopengine'),
							'type'      => Controls_Manager::COLOR,
							'alpha'     => false,
							'selectors' => [
								'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is(  button ):hover i, {{WRAPPER}} .shopengine-search-text:hover' => 'color: {{VALUE}}',
							],
						]
					);
			
					$this->add_control(
						'se_adv_search_btn_icon_bgc',
						[
							'label'     => esc_html__('Search Button Background Color', 'shopengine'),
							'type'      => Controls_Manager::COLOR,
							'alpha'     => false,
							'selectors' => [
								'{{WRAPPER}} .shopengine-advanced-search :is( .search-input-group button, .search-input-group ):hover' => 'background: {{VALUE}}; border-color:{{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();


		$this->add_control(
			'shopengine_advanced_search_font_size',
			[
				'label'      => esc_html__('Search Button Font Size', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 40,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is(  button ) i, {{WRAPPER}} .shopengine-search-text' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator'	 => 'before',
			]
		);

		$this->add_control(
			'shopengine_advanced_search_search_button_width',
			[
				'label'      => esc_html__('Search Button Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 40,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is(  button )' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_text_gap',
			[
				'label'      => esc_html__('Search Text Gap', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-search-text' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_advanced_add_search_text' => 'yes',
				],
			]
		);

		$this->end_controls_section(); // end ./ search icon style


		/*
			------------------------------
			category style
			------------------------------
		*/
		$this->start_controls_section(
			'shopengine_advanced_product_category_section',
			[
				'label' => esc_html__('Category Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_advanced_product_category_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3E3E3E',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is( select )' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_product_category_bg',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-category-select-wraper' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .shopengine-ele-nav-search-select'  => 'background-color: transparent',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_advanced_product_category_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-advanced-search .search-input-group :is( select )',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'      => esc_html__('Line-height (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_advanced_category_width',
			[
				'label'      => esc_html__('Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 40,
						'max'  => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-ele-nav-search-select' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_advanced_search_disable_category_btn' => 'block',
				],
			]
		);

		$this->add_control(
			'se_adv_search_cat_drop_color',
			[
				'label'		=> esc_html__( 'Dropdown Text Color', 'shopengine' ),
				'type'		=> Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors'	=> [
					'{{WRAPPER}} .shopengine-ele-nav-search-select > option'	=> 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'se_adv_search_cat_drop_bgc',
			[
				'label'		=> esc_html__( 'Dropdown Background Color', 'shopengine' ),
				'type'		=> Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors'	=> [
					'{{WRAPPER}} .shopengine-ele-nav-search-select > option'	=> 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'shopengine_advanced_separator_position',
			[
				'label'     => esc_html__('Separator Position', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '0',
				'options'   => [
					'left'   => [
						'title' => esc_html__('Left', 'shopengine'),
						'icon'  => 'fa fa-chevron-left'
					],
					'right'  => [
						'title' => esc_html__('Right', 'shopengine'),
						'icon'  => 'fa fa-chevron-right'
					],
				],
				'selectors_dictionary' => [
					'left' => 'right: auto; left: 0;',
					'right' => 'left: auto; right: 0;',
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-category-select-wraper:before' => '{{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_advanced_separator_width',
			[
				'label'      => esc_html__('Separator Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-category-select-wraper:before' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_separator_color',
			[
				'label'     => esc_html__('Separator Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-category-select-wraper:before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'shopengine_advanced_separator_width!' => 0,
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_advanced_separator_height',
			[
				'label'      => esc_html__('Separator Height', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-category-select-wraper:before' => 'height: {{SIZE}}%;',
				],
				'condition'  => [
					'shopengine_advanced_separator_width!' => 0,
				],
			]
		);


		$this->end_controls_section(); // end ./ category style


		/*
			------------------------------
			product wrap style
			------------------------------
		*/
		$this->start_controls_section(
			'shopengine_advanced_product_wrap_section',
			[
				'label' => esc_html__('Product Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_advanced_search_left_space',
			[
				'label'       => esc_html__('Space On the Left', 'shopengine'),
				'description' => esc_html__('Add space on the left side of the search result container.', 'shopengine'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => ['px'],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'   => [
					'{{WRAPPER}} .shopengine-search-result-container' => 'left: {{SIZE}}{{UNIT}}; width: calc(100% - {{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_right_space',
			[
				'label'       => esc_html__('Space On the Right', 'shopengine'),
				'description' => esc_html__('Add space on the right side of the search result container.', 'shopengine'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => ['px'],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'   => [
					'{{WRAPPER}} .shopengine-search-result-container' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
				'condition'   => [
					'shopengine_advanced_search_left_space' => '0',
				],
			]
		);




		$this->add_control(
			'shopengine_search_title_heading',
			[
				'label'     => esc_html__('Title:', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_advanced_search_product_title_clr',
			[
				'label'     => esc_html__('Title Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3E3E3E',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_product_title_hover_clr',
			[
				'label'     => esc_html__('Title Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_advanced_search_product_title_typography',
				'label'    => esc_html__('Title Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--title a',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '15',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'      => esc_html__('Line-height (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'responsive' => false,
						'size_units' => ['px'],
					],
				],
			]
		);


		$this->add_control(
			'shopengine_search_price_heading',
			[
				'label'     => esc_html__('Price:', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_advanced_search_product_reg_price_clr',
			[
				'label'     => esc_html__('Regular Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--price ins .amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_product_sell_price_clr',
			[
				'label'     => esc_html__('Sale Price Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--price del .amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_advanced_search_product_price_typography',
				'label'    => esc_html__('Price Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--price .amount',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'line_height', 'text_transform'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
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
			'shopengine_search_badge_heading',
			[
				'label'     => esc_html__('Discount Badge:', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_search_add_badge',
			[
				'label'        => esc_html__('Show Badge?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Hide', 'shopengine'),
				'label_off'    => esc_html__('Show', 'shopengine'),
				'return_value' => 'block',
				'default'      => 'none',
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-discount-badge' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_search_badge_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Badge Color', 'shopengine' ),
				'default' => '#ffffff',
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-discount-badge' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'shopengine_search_badge_background_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Badge Background Color', 'shopengine' ),
				'default' => '#F54F29',
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-discount-badge ' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_advanced_search_product_badge_typography',
				'label'    => esc_html__('Badge Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--price .shopengine-discount-badge',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
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

		$this->add_responsive_control(
			'shopengine_search_badge_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Badge Border Radius', 'shopengine' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-discount-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_search_rating_heading',
			[
				'label'     => esc_html__('Rating:', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_search_rating_size',
			[
				'label'      => esc_html__('Rating Font Size', 'shopengine'),
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
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-product-rating .star-rating, {{WRAPPER}} .shopengine-advanced-search .shopengine-product-rating .rating-count' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_search_rating_color',
			[
				'label'     => esc_html__('Star Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#fec42d',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating .star-rating::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .shopengine-product-rating .star-rating span::before' => 'color: {{VALUE}};'
				],
			]
		);



		$this->add_control(
			'product_rating_count_color',
			[
				'label'     => esc_html__('Counter', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#858585',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-rating .rating-count' => 'color: {{VALUE}}',
				],
			]
		);



		$this->add_control(
			'shopengine_search_more_btn_heading',
			[
				'label'     => esc_html__('Arrow Button:', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_search_more_btn_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#565969',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-search-more-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_search_more_btn_icon_bg_color',
			[
				'label'     => esc_html__('Icon Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(86, 89, 105, 0.1)',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-more-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_search_more_btn_icon_bg_color_hover',
			[
				'label'     => esc_html__('Icon Hover Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item:hover .shopengine-search-more-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_search_wrapper_heading',
			[
				'label'     => esc_html__('Product Item:', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_advanced_search_product_padding',
			[
				'label'      => esc_html__('Wrapper Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_advanced_search_product_border',
				'label'          => esc_html__('Border', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-advanced-search :is( .shopengine-product-search-result, .shopengine-search-product__item)',
				'fields_options' => [
					'border_type' => [
						'default' => 'yes',
					],
					'border'      => [
						'default'    => 'solid',
						'responsive' => false,
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
						'responsive' => false,
					],

					'color' => [
						'label'      => esc_html__('Border Color', 'shopengine'),
						'alpha'      => false,
						'default'    => '#E6E6E6',
						'responsive' => false,
					],

				],
			]
		);

		$this->end_controls_section(); // end ./ product wrap style

		// More Product button
		$this->start_controls_section(
			'shopengine_advanced_search_more_btn',
			[
				'label' => esc_html__('More Products Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_advanced_search_more_size',
			[
				'label'      => esc_html__('Font Size', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-search-more-products' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_more_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F03D3F',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-search-more-products' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_advanced_search_more_color_hover',
			[
				'label'     => esc_html__('Hover Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#bd1517',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-search-more-products:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		//global font family
		$this->start_controls_section(
			'shopengine_advanced_search_typography',
			array(
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'shopengine_advanced_search_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-advanced-search .search-input-group :is( input, input::placeholder ),
					{{WRAPPER}} .shopengine-advanced-search .shopengine-search-text,
					{{WRAPPER}} .shopengine-advanced-search .shopengine-product-rating .rating-count,
					{{WRAPPER}} .shopengine-advanced-search .search-input-group :is( select ),
					{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--title,
					{{WRAPPER}} .shopengine-advanced-search .shopengine-search-product__item--price' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


	}

	private function generate_order_item_css($order_items) {
		$styles = '';
		$parent_class = '.elementor-element-' . $this->get_id();

		foreach($order_items as $key => $item) {
			$order_number = $key + 1;
			if($item['list_key'] == 'search-box') {
				$styles .= $parent_class . ' .shopengine-advanced-search .search-input-group :is( button )  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'search-input') {
				$styles .= $parent_class . ' .shopengine-advanced-search-input  {order: '. $order_number .';}';
			}
			if($item['list_key'] == 'category-selector') {
				$styles .= $parent_class . ' .shopengine-category-select-wraper  {order: '. $order_number .';}';
			}
		}

		echo '<style>'.$styles.'</style>';
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();
		$post_type = get_post_type();

		if(!empty($settings['shopengine_custom_ordering_list'])) {
			$this->generate_order_item_css($settings['shopengine_custom_ordering_list']);
		}

		$product = Products::instance()->get_product($post_type);

		$tpl = Products::instance()->get_widget_template($this->get_name());

		include $tpl;
	}
}
