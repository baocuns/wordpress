<?php

namespace ShopEngine\Widgets\Init;

defined('ABSPATH') || exit;

class Enqueue_Scripts
{

	public function __construct() {

		add_action('wp_enqueue_scripts', [$this, 'frontend_js']);
		add_action('wp_enqueue_scripts', [$this, 'frontend_css'], 8);
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'editor_js']);
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'elementor_js']);
		add_action('elementor/editor/after_enqueue_styles', [$this, 'elementor_css']);
	}

	public function editor_js(){
		if(get_post_type() != 'shopengine-template'){
			return;
		}

		wp_enqueue_script('shopengine-editor-script', \ShopEngine::widget_url() . 'init/assets/js/editor.js', ['jquery', 'elementor-editor'], \ShopEngine::version(), true);
	}

	public function elementor_js() {
		// Font Awesome fallback support on Editor Mode.
		if ( defined( 'ELEMENTOR_ASSETS_URL' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			wp_enqueue_style( 'editor-font-awesome', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.css', [], \ShopEngine::version() );
		}


		wp_enqueue_script('shopengine-elementor-script', \ShopEngine::widget_url() . 'init/assets/js/widgets.js', ['jquery', 'elementor-frontend'], \ShopEngine::version(), true);

	}

	public function elementor_css() {
		wp_enqueue_style('shopengine-elementor-style', \ShopEngine::widget_url() . 'init/assets/css/widgets.css', null , \ShopEngine::version());
	}

	public function frontend_js() {
		wp_register_script('asrange-js', \ShopEngine::widget_url() . 'init/assets/js/jquery-asRange.min.js', [], \ShopEngine::version(), true);
	}

	public function frontend_css() {
		wp_enqueue_style('shopengine-widget-reset', \ShopEngine::widget_url() . 'init/assets/css/normalize.css', null, \ShopEngine::version());
		wp_enqueue_style('shopengine-widget-frontend', \ShopEngine::widget_url() . 'init/assets/css/widget-frontend.css', null, \ShopEngine::version());
	}
}
