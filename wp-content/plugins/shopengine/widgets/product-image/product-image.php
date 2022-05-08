<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Product_Image extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Product_Image_Config();
	}

	public function get_script_depends() {
		return ['wc-single-product'];
	}

	protected function register_controls() {

		/*
			--------------------------
			settings content tab
			--------------------------
		*/

		$this->start_controls_section(
			'shopengine_widget_settings',
			[
				'label' => esc_html__('Settings', 'shopengine'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shopengine_image_gallery_heading',
			[
				'label'     => esc_html__('Product Gallery', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		if(\ShopEngine::package_type() == 'free'){
			$this->add_control(
				'shopengine_image_gallery_info',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => esc_html__('In the ShopEngine pro version, the thumbnail gallery will be slider automatically and you can move it to the left and right side of the feature image too.', 'shopengine'),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				]
			);
		}

		$position_opts = [
			'bottom'  => __( 'Bottom', 'shopengine' )
		];

		if(\ShopEngine::package_type() == 'pro'){
			$position_opts['left'] = __( 'Left', 'shopengine' );
			$position_opts['right'] = __( 'Right', 'shopengine' );
		}

		$this->add_control(
			'shopengine_image_gallery_position',
			[
				'label' => __( 'Position', 'shopengine' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => $position_opts,
				'prefix_class' => 'shopengine_image_gallery_position_',
			]
		);

		$this->add_control(
			'shopengine_image_lightbox_icon_heading',
			[
				'label'     => esc_html__('Product Lightbox', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_image_lightbox_icon',
			[
				'label'            => esc_html__('Icon', 'shopengine'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-expand-alt',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'shopengine_sale_flash_status_heading',
			[
				'label'     => esc_html__('Flash Sale Badge', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_sale_flash_status',
			[
				'label'        => esc_html__('Show Badge?', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'render_type'  => 'template',
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section(); // end ./settings content tab

		/*
			--------------------------
			product image style
			--------------------------
		*/

		$this->start_controls_section(
			'shopengine_image_style',
			[
				'label' => esc_html__('Image', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'shopengine_image_bgc',
				[
					'label'		=> esc_html__( 'Background Color', 'shopengine' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} img, .pswp__img' => 'background-color: {{VALUE}};',
					],
				]
			);

		$this->add_control(
			'shopengine_image_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .shopengine-product-image .woocommerce-product-gallery__trigger + .woocommerce-product-gallery__wrapper,
                    .woocommerce {{WRAPPER}} .shopengine-product-image .img-thumbnail,
					.woocommerce {{WRAPPER}} .shopengine-product-image .flex-viewport' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_heading_gallery_thumbs_style',
			[
				'label'     => esc_html__('Gallery Thumbnails', 'shopengine'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'shopengine_gallery_thumbs_width',
			[
				'label'      => esc_html__('Width', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => '%',
				],
				'tablet_default' => [
					'size' => 25,
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 25,
					'unit' => '%',
				],
				'default' => [
					'size' => 20,
					'unit' => '%',
				],
				'selectors'  => [
					'{{WRAPPER}}:not(.shopengine_image_gallery_position_bottom) .shopengine-gallery-wrapper' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.shopengine_image_gallery_position_bottom .flex-control-thumbs li' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.shopengine_image_gallery_position_left .flex-viewport, {{WRAPPER}}.shopengine_image_gallery_position_right .flex-viewport' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
					'{{WRAPPER}}.shopengine_image_gallery_position_left .shopengine-product-image .onsale, {{WRAPPER}}.shopengine_image_gallery_position_left .shopengine-product-image-toggle' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}.shopengine_image_gallery_position_right .shopengine-product-image .onsale, {{WRAPPER}}.shopengine_image_gallery_position_right .shopengine-product-image-toggle' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'shopengine_thumbs_border',
				'selector'       => '.woocommerce {{WRAPPER}} .shopengine-product-image .flex-control-thumbs img,
                .woocommerce {{WRAPPER}} .shopengine-product-image .product-thumbs-slider .img-thumbnail,
                .woocommerce {{WRAPPER}} .woocommerce-product-gallery #product-thumbnails-carousel .slick-slide:hover img,
                .woocommerce {{WRAPPER}} .woocommerce-product-gallery #product-thumbnails-carousel .slick-current img',
				'fields_options' => [
					'color' => [
						'label' => esc_html__('Border Color', 'shopengine'),
						'alpha' => false,
					],

				],
			]
		);

		$this->add_control(
			'shopengine_thumbs_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .shopengine-product-image .flex-control-thumbs img,
                    .woocommerce {{WRAPPER}} .shopengine-product-image .product-thumbs-slider .img-thumbnail,
                    .woocommerce-product-gallery #product-thumbnails-carousel .slick-slide:hover img,
                    .woocommerce-product-gallery #product-thumbnails-carousel .slick-current img'
					=> 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'shopengine_gallery_thumbs_row_gap',
			[
				'label'      => esc_html__('Row Gap (px)', 'shopengine'),
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
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .flex-control-thumbs li'                      => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-image .flex-control-thumbs'                      => 'margin-left:-{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-image .product-thumbs-slider:not( .owl-loaded )' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-image .product-thumbs-slider .owl-stage'         => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$column_condition = [];

		if(\ShopEngine::package_type() == 'pro'){
			$column_condition = [
				'shopengine_image_gallery_position!' => 'bottom'
			];
		}

		$this->add_control(
			'shopengine_gallery_thumbs_column_gap',
			[
				'label'      => esc_html__('Column Gap (px)', 'shopengine'),
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
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .flex-control-thumbs li'                      => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-image .flex-control-thumbs'                      => 'margin-top:-{{SIZE}}{{UNIT}};margin-bottom: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-product-image .product-thumbs-slider:not( .owl-loaded )' => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};;',
					'{{WRAPPER}} .shopengine-product-image .product-thumbs-slider .owl-stage'         => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};;',
				],
				'condition'	=> $column_condition
			]
		);

		$this->add_responsive_control(
			'shopengine_thumbs_margin',
			[
				'label'      => esc_html__('Margin Top (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '5',
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .flex-control-thumbs'   => 'margin-top: {{SIZE}}px;',
					'{{WRAPPER}} .shopengine-product-image .product-thumbs-slider' => 'margin-top: {{SIZE}}px;',
				],
				'separator'	 => 'before',
				'condition'	=> [
					'shopengine_image_gallery_position' => 'bottom',
				]
			]
		);

		$this->end_controls_section(); // end ./ product image style

		/*
			--------------------------
			lightbox zoom icon
			--------------------------
		*/

		$this->start_controls_section(
			'shopengine_lightbox_icon_style',
			[
				'label' => esc_html__('Lightbox Zoom Icon', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_border_color',
			[
				'label'     => esc_html__('Icon Border Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'border:1px solid {{VALUE}}; box-shadow:none;-webkit-box-shadow:none;',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_background',
			[
				'label'     => esc_html__('Icon Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_size',
			[
				'label'      => esc_html__('Size (px)', 'shopengine'),
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
					'size' => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_wrapper_size',
			[
				'label'      => esc_html__('Wrapper Size (px)', 'shopengine'),
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
					'size' => 46,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_position',
			[
				'label'     => esc_html__('Position', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
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
				'default'   => 'top-right',
				'toggle'    => false,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_position_x_axis',
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
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_lightbox_icon_position' => 'custom',
				],
			]
		);

		$this->add_control(
			'shopengine_lightbox_icon_position_y_axis',
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
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .shopengine-product-image-toggle' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_lightbox_icon_position' => 'custom',
				],
			]
		);

		$this->end_controls_section(); // end ./ lightbox zoom icon

		/*
			--------------------------
			Flash sale badge style
			--------------------------
		*/
		$this->start_controls_section(
			'shopengine_flash_sale_badge_style',
			[
				'label'     => esc_html__('Flash Sale Badge', 'shopengine'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'shopengine_sale_flash_status' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_background',
			[
				'label'     => esc_html__('Background Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8fa775',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_onsale_primary',
				'label'    => esc_html__('Typography', 'shopengine'),
				'selector' => '{{WRAPPER}} .shopengine-product-image .onsale',
				'exclude'  => ['letter_spacing', 'text_decoration', 'font_weight', 'font_style'],

				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
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
						'label'      => esc_html__('Line-height (px)', 'shopengine'),
						'default'    => [
							'size' => '20',
							'unit' => 'px',
						],
						'size_units' => ['px'],
					],
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_height_width_status',
			[
				'label'        => esc_html__('Fixed Height Width', 'shopengine'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'shopengine'),
				'label_off'    => esc_html__('Hide', 'shopengine'),
				'render_type'  => 'template',
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'shopengine_flash_sale_height',
			[
				'label'      => esc_html__('Height (px)', 'shopengine'),
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
					'size' => 70,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_flash_sale_height_width_status' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_width',
			[
				'label'      => esc_html__('Width (px)', 'shopengine'),
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
					'size' => 70,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'shopengine_flash_sale_height_width_status' => 'yes',
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'shopengine'),
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
					'size' => 70,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_position',
			[
				'label'     => esc_html__('Position', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
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
				'default'   => 'top-left',
				'toggle'    => false,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shopengine_flash_sale_position_x_axis',
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
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_flash_sale_position' => 'custom',
				],
			]
		);

		$this->add_control(
			'shopengine_flash_sale_position_y_axis',
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
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .shopengine-product-image .onsale' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'shopengine_flash_sale_position' => 'custom',
				],
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
		$settings = $this->get_settings_for_display();
		?>

        <div class="shopengine-product-image <?php echo \ShopEngine::package_type() == 'pro' ? 'shopengine-gallery-slider' : 'shopengine-gallery-slider-no' ?>">
            <a href="#"
               class="shopengine-product-image-toggle position-<?php echo esc_attr($settings['shopengine_lightbox_icon_position']); ?>">
				<?php Icons_Manager::render_icon($settings['shopengine_image_lightbox_icon'], ['aria-hidden' => 'true']); ?>
            </a>
			<?php echo \ShopEngine\Utils\Helper::render($this->view_render($settings)); ?>
        </div>

		<?php
	}


	protected function view_render($settings = []) {

		$product = wc_get_product();

		if(empty($product)) {
			$product = Products::instance()->get_product('');
		}

		$tpl = Products::instance()->get_widget_template('shopengine-product-image');

		include $tpl;
	}
}
