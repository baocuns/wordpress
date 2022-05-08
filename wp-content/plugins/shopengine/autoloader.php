<?php

namespace ShopEngine;


defined('ABSPATH') || exit;

/**
 * ShopEngine autoloader.
 * Handles dynamically loading classes only when needed.
 *
 * @since 1.0.0
 */
class Autoloader
{

	/**
	 * Run autoloader.
	 * Register a function as `__autoload()` implementation.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function run() {
		spl_autoload_register([__CLASS__, 'autoload']);
	}


	/**
	 *
	 * @param $class_name
	 */
	private static function autoload($class_name) {

		if(0 !== strpos($class_name, __NAMESPACE__)) {
			return;
		}

		$file_name = strtolower(
			preg_replace(
				['/\b' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'],
				['', '$1-$2', '-', DIRECTORY_SEPARATOR],
				$class_name
			)
		);


		$file = plugin_dir_path(__FILE__) . $file_name . '.php';

		if(file_exists($file)) {

			require_once($file);
		}
	}
}


/**
 * Calling the autoloader to class files
 *
 */
Autoloader::run();


