<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Widgets\Products;

class ShopEngine_Product_Review extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Review_Config();
	}

	protected function register_controls() {

		/*
			---------------------------
			review heading
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_section_product_review_heading',
			[
				'label' => esc_html__('Heading', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_review_heading_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-review :is(#reviews #comments .woocommerce-Reviews-title, #review_form .comment-reply-title)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'shopengine_product_review_heading_typography',
				'label'          => esc_html__('Typography', 'shopengine'),
				'selector'       => '{{WRAPPER}} .shopengine-product-review :is(#reviews #comments .woocommerce-Reviews-title, #review_form .comment-reply-title)',
				'exclude'        => ['font_family', 'text_decoration', 'font_style'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'    => [
						'default' => '600',
					],
					'font_size'      => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '22',
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
					'letter_spacing' => [
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'default' => [
							'size' => '0.1',
						],
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_responsive_control(
			'shopengine_product_review_title_margin',
			[
				'label' => esc_html__( 'Margin (px)', 'shopengine' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-review :is(#reviews #comments .woocommerce-Reviews-title, #review_form .comment-reply-title)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; padding: 0;',
				],
                'separator'	=> 'before',
			]
		);

		$this->end_controls_section();

		/*
			---------------------------
			review styles
			---------------------------
		*/

		$this->start_controls_section(
			'shopengine_product_review_style',
			[
				'label' => esc_html__('Review Style', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_review_rating_color',
			[
				'label'     => esc_html__('Rating Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEC42D',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #reviews .star-rating'								=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews .star-rating span'							=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews .star-rating span::before'					=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews .star-rating::before'						=> 'color: {{VALUE}};', 
					'{{WRAPPER}} div.shopengine-product-review #reviews p.stars a'									=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews p.stars.selected a'							=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews p.stars:hover a'							=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews p.stars a::before'							=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews p.stars a.active~a::before'					=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews .se-rating-container .star-rating span'		=> 'color: {{VALUE}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews .se-rating-container .star-rating::before'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_date_color',
			[
				'label'     => esc_html__('Date, Author and Description Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review :is(.woocommerce-review__published-date, .description p, .woocommerce-review__author, .woocommerce-review__verified, .woocommerce-review__dash)'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_separator_color',
			[
				'label'     => esc_html__('Comment Separator Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EFEFEF',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #reviews #comments .commentlist li'	=> 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_review_author_typography',
				'label'    => esc_html__('Author Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-review .woocommerce-review__author',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'line_height', 'font_style', 'text_transform'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size (px)', 'shopengine'),
						'default'    => [
							'size' => '18',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_review_date_typography',
				'label'    => esc_html__('Date Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-review :is(.woocommerce-review__published-date, .woocommerce-review__dash, .woocommerce-review__verified)',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'line_height', 'font_style', 'text_transform'],
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
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
						'selectors' => [
							'{{WRAPPER}} div.shopengine-product-review :is(.woocommerce-review__published-date, .woocommerce-review__dash, .woocommerce-review__verified)'	=> 'font-size: {{SIZE}}{{UNIT}} !important',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_review_description_typography',
				'label'    => esc_html__('Description Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-review .description p',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '28',
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
			]
		);

		$this->add_control(
			'shopengine_product_review_single_spacing',
			[
				'label'      => esc_html__('Single Review Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-review #reviews #comments .commentlist li:not(:last-child)'	=> 'margin-bottom: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} div.shopengine-product-review #reviews #comments .commentlist li:last-child'		=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section(); // end /review styles

		/*
		   ---------------------------
		   review form
		   ---------------------------
	   */

		$this->start_controls_section(
			'shopengine_product_review_table',
			[
				'label' => esc_html__('Review Form', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_review_label_heading',
			[
				'label' => esc_html__('Input Label', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'shopengine_product_review_label_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9C9C9',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(label, .comment-notes)'	=> 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_label_required',
			[
				'label'     => esc_html__('Required Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EA4335',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .required' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_review_label_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(label, .comment-notes)',
				'exclude'  => ['font_family', 'text_decoration', 'font_style', 'text_transform'],
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
							'size' => '14',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
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
					'letter_spacing' => [
						'label'      => esc_html__('Letter Spacing (px)', 'shopengine'),
						'default' => [
							'size' => '0',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_input_heading',
			[
				'label' => esc_html__('Form Input', 'shopengine'),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_review_input_clr',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(input:not([type=checkbox]), textarea)'	=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_input_border_clr',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F2F2F2',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(textarea, input:not(.submit))' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_input_border_focus_clr',
			[
				'label'     => esc_html__('Focus Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#505255',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(textarea:focus, input:focus, .comment-form-cookies-consent input::after)' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_review_label_input_typography',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(input:not([type=checkbox]), textarea)',
				'exclude'  => ['font_family', 'letter_spacing', 'text_decoration', 'font_style', 'text_transform'],
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
						'size_units' => ['px'],
					],
					'line_height' => [
						'label'   => esc_html__('Line Height (px)', 'shopengine'),
						'default' => [
							'size' => '19',
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
			]
		);

		$this->add_control(
			'shopengine_product_review_field_spacing',
			[
				'label'      => esc_html__('Field Spacing (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond :is(.comment-form)'			=> 'margin: 0;',
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(.comment-notes, .comment-form-rating, .comment-form-comment, .comment-form-author, .comment-form-email, .comment-form-cookies-consent)'	=> 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_product_review_input_border_radius',
			[
				'label'      => esc_html__('Inputs Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(textarea, input)'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'shopengine_product_review_input_padding',
            [
                'label'      => esc_html__('Inputs Padding (px)', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => true,
				],
                'selectors'  => [
                    '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form :is(textarea, input:not(#wp-comment-cookies-consent, .submit))' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator'  => 'before',
            ]
        );

		$this->end_controls_section(); // end /review form

		/*
			---------------------------------
		  	submit button
			------------------------------------
		 */

		$this->start_controls_section(
			'shopengine_product_review_submit_button_section',
			[
				'label' => esc_html__('Submit Button', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_product_review_submit_button_typography',
				'label'    => esc_html__('Button Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit',
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
					'line_height'    => [
						'label'      => esc_html__('Line Height (px)', 'shopengine'),
						'default'    => [
							'size' => '19',
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
			]
		);

        $this->add_responsive_control(
            'shopengine_product_review_submit_button_alignment',
            [
                'label'     => esc_html__('Alignment', 'shopengine'),
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit'			=> 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit'	=> 'float: none;',
                ],
            ]
        );

		$this->start_controls_tabs(
			'shopengine_product_review_submit_button_tabs',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'shopengine_product_review_submit_button_tab_normal',
			[
				'label' => esc_html__('Normal', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_product_review_submit_button_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_submit_button_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3A3A3A',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'shopengine_product_review_submit_button_tab_hover',
			[
				'label' => esc_html__('Hover', 'shopengine'),
			]
		);

		$this->add_control(
			'shopengine_product_review_submit_button_hover_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_submit_button_hover_bg',
			[
				'label'     => esc_html__('Background', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'shopengine_product_review_submit_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_product_review_submit_button_border',
				'label'          => esc_html__('Border (px)', 'shopengine'),
				'size_units'     => ['px'],
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'label'	=> esc_html__('Width (px)', 'shopengine'),
						'default' => [
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						],
						'responsive' => false,
					],
					'color'  => [
						'default'	=> '#3A3A3A',
						'alpha'		=> false,
					]
				],
				'selector'       => '{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'shopengine_product_review_submit_button_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'shopengine_product_review_submit_button_padding',
			[
				'label'      => esc_html__('Padding (px)', 'shopengine'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '10',
					'right'    => '25',
					'bottom'   => '10',
					'left'     => '25',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} div.shopengine-product-review #review_form #respond .comment-form .form-submit input#submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section(); // end ./ submit button

		$this->start_controls_section(
			'shopengine_product_review_global_font',
			[
				'label' => esc_html__('Global Font', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_review_font_family',
			[
				'label'       => esc_html__('Font Family', 'shopengine'),
				'description' => esc_html__('This font family is set for this specific widget.', 'shopengine'),
				'type'        => Controls_Manager::FONT,
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .shopengine-product-review' => 'font-family: {{VALUE}} !important;',
					'{{WRAPPER}} .shopengine-product-review #reviews :is(a, h2, p, input, .meta span, em, time, .submit, .woocommerce-Reviews-title, .comment-reply-title)' => 'font-family: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();

		$product = Products::instance()->get_product($post_type);


		$tpl = Products::instance()->get_widget_template($this->get_name());

		$this->avatar_size = isset($settings['shopengine_product_review_author_avatar_width']['size']) ? $settings['shopengine_product_review_author_avatar_width']['size'] : 60;

		add_filter( 'pre_get_avatar_data', [$this, 'change_avatar_size'], 99, 2);

		include $tpl;
	}

	private $avatar_size;

	public function change_avatar_size($args, $id_or_email) {

		$args['size'] = $this->avatar_size;

		return $args;
	}
}
