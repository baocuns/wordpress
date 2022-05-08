<?php

namespace Elementor;

defined('ABSPATH') || exit;

use ShopEngine\Core\Template_Cpt;
use ShopEngine\Widgets\Products;


class ShopEngine_Product_Share extends \ShopEngine\Base\Widget
{

	public function config() {
		return new ShopEngine_Product_Share_Config();
	}


	protected function register_controls() {
		/*
		* Style Tab - Product Share
		*/
		$this->start_controls_section(
			'shopengine_section_share_styles',
			[
				'label' => esc_html__('Styles', 'shopengine'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shopengine_product_share_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s <a href="https://wordpress.org/plugins/wp-social/" target="_blank">Wp Social</a> %2$s', 
					esc_html__('You need to install', 'shopengine'),
					esc_html__('plugin or sharing plugins like this one can hook into here or you can add your own code directly. Hook: woocommerce_share', 'shopengine')
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->end_controls_section();
	}


	protected function screen() {

		$settings = $this->get_settings_for_display();

		$post_type = get_post_type();

		if($post_type == 'product' || $post_type == Template_Cpt::TYPE) {

			$product = Products::instance()->get_product($post_type);

			$tpl = Products::instance()->get_widget_template($this->get_name());

			include $tpl;

		} else {

			esc_html_e('You are trying to view the page outside the builder or the Product page.', 'shopengine');
		}
	}
}
