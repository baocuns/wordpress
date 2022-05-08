<?php 
namespace ShopEngine\Base;

defined('ABSPATH') || exit;

abstract class Widget_Config{

    abstract public function get_name();

	abstract public function get_title();

	abstract public function get_icon();

	abstract public function get_categories();

	abstract public function get_keywords();

    abstract public function get_template_territory();

    public function custom_inline_css() {
        return false;
    }

    public function custom_inline_js() {
        return false;
    }

    public function custom_localize_js() {
        return false;
    }

    public function custom_init() {
        return false;
    }

    public function get_widget_url() {
        return \ShopEngine::widget_url() . $this->get_name() . '/';
    }

    public function get_widget_dir() {
        return \ShopEngine::widget_dir() . $this->get_name() . '/';
    }    
}