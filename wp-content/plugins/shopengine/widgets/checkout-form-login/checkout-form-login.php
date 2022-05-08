<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Checkout_Form_Login extends \ShopEngine\Base\Widget {

    public function config() {
        return new ShopEngine_Checkout_Form_Login_Config();
    }

    protected function register_controls() {
        /**
         * Checkbox label title
         */
        $this->start_controls_section(
            'shopengine_heading_section',
            [
                'label' => esc_html__('Toggle Heading', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'shopengine_heading_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#3A3A3A',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login-toggle .woocommerce-info' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'shopengine_heading_link_color',
            [
                'label'     => esc_html__('Link Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4169E1',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login-toggle .woocommerce-info a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'shopengine_heading_background',
            [
                'label'     => esc_html__('Heading Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F5F5F5',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login-toggle .woocommerce-info' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'shopengine_heading_border',
                'label'          => esc_html__('Border', 'shopengine'),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid'
                    ],
                    'width'  => [
                        'default' => [
                            'top'      => 2,
                            'right'    => 0,
                            'bottom'   => 0,
                            'left'     => 0,
                            'isLinked' => true
                        ]
                    ],
                    'color'  => [
                        'default' => '#D4D4D4'
                    ]
                ],
                'selector'       => '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login-toggle'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'shopengine_description_section',
            [
                'label' => esc_html__('Text', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'shopengine_description_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#747474',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .shopengine-checkout-login-form > p:not(.form-row)' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'shopengine_description_link_color',
            [
                'label'     => esc_html__('Link Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4169E1',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .shopengine-checkout-login-form p a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'shopengine_input_label_section',
            [
                'label' => esc_html__('Label', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'shopengine_input_label_color',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#3A3A3A',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .form-row label' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'shopengine_input_required_indicator_color',
            [
                'label'     => esc_html__('Required Indicator Color:', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#FF0000',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .form-row label .required' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'shopengine_input_label_margin',
            [
                'label'      => esc_html__('Margin', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'unit'     => 'px',
                    'top'      => 0,
                    'right'    => 0,
                    'bottom'   => 9,
                    'left'     => 0,
                    'isLinked' => true
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'shopengine_input_section',
            [
                'label' => esc_html__('Input', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('shopengine_input_tabs_style');

        $this->start_controls_tab(
            'shopengine_input_tabnormal',
            [
                'label' => esc_html__('Normal', 'shopengine')
            ]
        );

        $this->add_control(
            'shopengine_input_color',
            [
                'label'     => esc_html__('Input Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login input' => 'color: {{VALUE}};'
                ],
                'default'   => '#000000'
            ]
        );

        $this->add_control(
            'shopengine_input_background',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login input' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'shopengine_input_border',
                'label'    => esc_html__('Border', 'shopengine'),
                'selector' => '.woocommerce {{WRAPPER}} .shopengine-checkout-form-login input'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'shopengine_input_tabfocus',
            [
                'label' => esc_html__('Focus', 'shopengine')
            ]
        );

        $this->add_control(
            'shopengine_input_color_focus',
            [
                'label'     => esc_html__('Input Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login input:focus' => 'color: {{VALUE}};'
                ],
                'default'   => '#101010'
            ]
        );

        $this->add_control(
            'shopengine_input_background_focus',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login input:focus' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'shopengine_input_border_focus',
                'label'    => esc_html__('Border', 'shopengine'),
                'selector' => '{{WRAPPER}} .shopengine-checkout-form-login input:focus'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'shopengine_input_padding',
            [
                'label'      => esc_html__('Padding', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'unit'     => 'px',
                    'top'      => 12,
                    'right'    => 18,
                    'bottom'   => 12,
                    'left'     => 18,
                    'isLinked' => true
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-checkout-form-login input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        /**
         * Button controls
         */
        $this->start_controls_section(
            'shopengine_button_section',
            [
                'label' => esc_html__('Button', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('shopengine_button_tab');

        $this->start_controls_tab(
            'shopengine_button_tabnormal',
            [
                'label' => esc_html__('Normal', 'shopengine')
            ]
        );

        $this->add_control(
            'shopengine_button_colornormal',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'shopengine_button_backgroundnormal',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3A3A3A',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'shopengine_button_tabhover',
            [
                'label' => esc_html__('Hover', 'shopengine')
            ]
        );

        $this->add_control(
            'shopengine_button_colorhover',
            [
                'label'     => esc_html__('Color', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'shopengine_button_backgroundhover',
            [
                'label'     => esc_html__('Background', 'shopengine'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit:hover' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'shopengine_button_border',
                'label'     => esc_html__('Border', 'shopengine'),
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit'
            ]
        );

        $this->add_responsive_control(
            'shopengine_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'shopengine'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 3
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'shopengine_button_box_shadow',
                'label'    => esc_html__('Box Shadow', 'shopengine'),
                'selector' => '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit'
            ]
        );

        $this->add_responsive_control(
            'shopengine_button_margin',
            [
                'label'      => esc_html__('Margin', 'shopengine'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'unit'     => 'px',
                    'top'      => 0,
                    'right'    => 20,
                    'bottom'   => 10,
                    'left'     => 0,
                    'isLinked' => true
                ],
                'selectors'  => [
                    '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Typography Section
         */
        $this->start_controls_section(
            'shopengine_typography_section',
            [
                'label' => esc_html__('Typography', 'shopengine'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'shopengine_typography_primary',
                'label'    => esc_html__('Primary Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .shopengine-checkout-form-login .woocommerce-info, {{WRAPPER}} .shopengine-checkout-form-login p'
            ]
        );

        $this->add_control(
            'shopengine_typography_primary_desc',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('Primary Typography : Toggle Heading, Text', 'shopengine'),
                'content_classes' => 'elementor-control-field-description',
                'separator'       => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'shopengine_typography_secondary',
                'label'    => esc_html__('Secondary Typography', 'shopengine'),
                'selector' => '{{WRAPPER}} .shopengine-checkout-form-login input, {{WRAPPER}} .shopengine-checkout-form-login .woocommerce-form-login__submit'
            ]
        );

        $this->add_control(
            'shopengine_typography_secondary_desc',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('Secondary Typography : Input, Submit Button', 'shopengine'),
                'content_classes' => 'elementor-control-field-description'
            ]
        );

        $this->end_controls_section();
    }

    protected function screen() {

        $settings = $this->get_settings_for_display();

        $post_type = get_post_type();

        $tpl = Products::instance()->get_widget_template($this->get_name());

        include $tpl;
    }
}
