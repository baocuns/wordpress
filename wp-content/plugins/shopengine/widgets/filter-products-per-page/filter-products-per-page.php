<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Filter_Products_Per_Page extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Filter_Products_Per_Page_Config();
	}

	protected function register_controls() {
		/**
		 * Section: Products Per Page Filter.
		 */
		$this->start_controls_section(
			'shopengine_section_ppp',
			[
				'label' => esc_html__('Products Per Page Filter', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_ppp_list',
			[
				'label'			=> esc_html__('Lists', 'shopengine'),
				'description'	=> esc_html__('Input number separate by comma, ex: 9, 12, 18, 24', 'shopengine'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> '9, 12, 18, 24',
				'label_block'	=> true,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shopengine_ppp_font',
				'selector' => '{{WRAPPER}} .shopengine-products-per-page label',
				'exclude'  => ['text_transform', 'font_style', 'text_decoration', 'letter_spacing'],
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_size'  => [
						'size_units' => ['px'],
						'default'    => [
							'size' => '16',
							'unit' => 'px'
						],
						'responsive' => false,
					],
					'line_height' => [
						'size_units' => ['px'],
						'responsive' => false,
					]
				],
			]
		);

		$this->add_control(
			'shopengine_ppp_spacing',
			[
				'label'     => esc_html__('Spacing (px)', 'shopengine'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-products-per-page label:not(:last-child)'		=> 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shopengine-products-per-page label:after'					=> 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .shopengine-products-per-page label:not(:last-child)'	=> 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
					'.rtl {{WRAPPER}} .shopengine-products-per-page label:after'			=> 'margin-right: {{SIZE}}{{UNIT}}; margin-left: 0;',
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'shopengine_ppp_alignment',
			[
				'label'     => esc_html__('Alignment', 'shopengine'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'   => [
						'description' => esc_html__('Left', 'shopengine'),
						'icon'        => 'eicon-text-align-left',
					],
					'center' => [
						'description' => esc_html__('Center', 'shopengine'),
						'icon'        => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'description' => esc_html__('Right', 'shopengine'),
						'icon'        => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shopengine-products-per-page' => 'display: flex; justify-content: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'shopengine_ppp_color',
			[
				'label'     => esc_html__('Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-products-per-page label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shopengine_ppp_active_color',
			[
				'label'     => esc_html__('Active Color', 'shopengine'),
				'type'      => Controls_Manager::COLOR,
				'alpha'		=> false,
				'selectors' => [
					'{{WRAPPER}} .shopengine-products-per-page input:checked + span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function screen() {
		$settings = $this->get_settings_for_display();
		?>

        <form action="" method="get" class="shopengine-filter shopengine-products-per-page">
			<?php
			$lists = is_string($settings['shopengine_ppp_list']) ? $settings['shopengine_ppp_list'] : '9, 12, 18, 24';
			$lists = explode(',', $lists);
			if($lists) {
				foreach($lists as $list) {
					$list = (int) $list;
					$is_checked = get_query_var('posts_per_page') === $list ? 'checked' : '';
					?>
                    <label>
                        <input type="radio" name="shopengine_products_per_page" value="<?php echo esc_attr($list); ?>" <?php echo esc_attr($is_checked); ?>>
                        <span><?php echo esc_html($list); ?></span>
                    </label>
					<?php
				}
			}
			?>
        </form>

		<?php
	}
}
