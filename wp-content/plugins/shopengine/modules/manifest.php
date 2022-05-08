<?php

namespace ShopEngine\Modules;

defined('ABSPATH') || exit;

use ShopEngine\Core\Register\Module_List;


class Manifest
{

	private $module_list;

	public function init() {

		add_action('init', [$this, 'manifest_modules'], 0);
	}

	public function manifest_modules() {

		foreach(Module_List::instance()->get_list(true, 'active') as $module) {

			if($module['status'] != 'active') {
				continue;
			}
			if($module['package'] === 'pro-disabled') {
				continue;
			}

			if(isset($module['path'])) {

				$fl = $module['path'] . '/' . $module['slug'] . '.php';

				if(file_exists($fl)) {

					require_once $fl;
				}
			}

			$module['base_class']::instance()->init();

		}

 		if ( !wp_doing_ajax() && strpos($_SERVER['REQUEST_URI'], 'wp-json/') === false ) {
		    do_action('shopengine/module/comparison-module-pro-support');
 		}


	}
}
