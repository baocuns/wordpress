<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_Image_Config extends \ShopEngine\Base\Widget_Config {

	public function __construct() {
		if(\ShopEngine::package_type() == 'pro') {
			add_filter( 'woocommerce_single_product_carousel_options', [$this, 'woo_update_flexslider_options'] );
		}
	}

	function woo_update_flexslider_options( $options ) {
		$options['directionNav'] = true;
		$options['touch'] = false;
		$options['manualControls'] = ".flex-control-nav li";
  
		return $options;
	}

	public function get_name() {
		return 'single-product-images';
	}


	public function get_title() {
		return esc_html__('Product Images', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-product_images';
	}


	public function get_categories() {
		return ['shopengine-single'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shop', 'shopengine', 'image', 'product', 'gallery', 'lightbox'];
	}


	public function get_template_territory() {
		return ['single', 'quick_view', 'quick_checkout'];
	}
}
