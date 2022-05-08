<?php

namespace Elementor;

use ShopEngine\Widgets\Products;

defined('ABSPATH') || exit;

class ShopEngine_Notice extends \ShopEngine\Base\Widget {

	public function config() {
		return new ShopEngine_Notice_Config();
	}

	protected function register_controls() {

	}

	protected function screen() {
		$tpl = Products::instance()->get_widget_template($this->get_name());
		include $tpl;
	}
}
