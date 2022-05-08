<?php

namespace ShopEngine\Utils;

defined('ABSPATH') || exit;

/**
 * Global helper class.
 *
 * @since 1.0.0
 */
class Controls_Helper {


	public static function get_alignment_conf($prefix = 'elementor%s-align-', $def = 'left', $selectors = [], $selector = []) {

		$arr = [
			'label'        => esc_html__('Alignment', 'shopengine'),
			'type'         => \Elementor\Controls_Manager::CHOOSE,
			'options'      => [
				'left'   => [
					'title' 	=> esc_html__('Left', 'shopengine'),
					'icon'		=> 'eicon-text-align-left',
				],
				'center' => [
					'title'		=> esc_html__('Center', 'shopengine'),
					'icon'		=> 'eicon-text-align-center',
				],
				'right'  => [
					'title'		=> esc_html__('Right', 'shopengine'),
					'icon'		=> 'eicon-text-align-right',
				],
			],
			'prefix_class' => $prefix,
			'default'      => $def,
		];


		if(!empty($selectors)) {

			$arr['selectors'] = $selectors;
		}

		if(!empty($selector)) {

			$arr['selector'] = $selector;
		}

		return $arr;
	}
	
}
