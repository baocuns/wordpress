<?php

namespace ShopEngine\Traits;

/**
 * Singleton trait
 * get instance
 *
 * @since 1.0.0
 */
trait Singleton {

	private static $instance;

	public static function instance() {
		if(!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}