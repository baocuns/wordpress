<?php

namespace ShopEngine\Core\Page_Templates\Hooks;

use ShopEngine\Compatibility\Conflicts\Theme_Hooks;
use ShopEngine\Core\Builders\Templates;

defined('ABSPATH') || exit;

class Shop extends Archive {

	protected $page_type = 'shop';
	protected $template_part = 'content-shop.php';

	protected function template_include_pre_condition(): bool {
		return is_shop();
	}

}
