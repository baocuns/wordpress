<?php

namespace ShopEngine\Traits;

use ShopEngine\Core\Builders\Templates;

/**
 * Singleton trait
 * get instance
 *
 * @since 1.0.0
 */
trait Singleton_Page {

	private static $instance;
	private $config;

	public static function instance() {
		if(!self::$instance) {
			self::$instance = new self();
			self::$instance->config = Templates::get_template_types()[self::$instance->page_type];
		}

		return self::$instance;
	}
}