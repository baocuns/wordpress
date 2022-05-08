<?php

namespace ShopEngine\Core\Page_Templates\Hooks;

use ShopEngine\Core\Builders\Templates;

defined('ABSPATH') || exit;

class Single extends Base {

	protected $page_type = 'single';
	protected $template_part = 'content-single-product.php';

	public function init() : void {
		// nothing is going on here
	}

	protected function get_page_type_option_slug(): string {

		return !empty($_REQUEST['shopengine_quickview']) && $_REQUEST['shopengine_quickview'] === 'modal-content' ? 'quick_view' : $this->page_type;
	}

	protected function template_include_pre_condition() : bool {

		return is_product();
	}

}
