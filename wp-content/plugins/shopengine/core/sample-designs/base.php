<?php

namespace ShopEngine\Core\Sample_Designs;

use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

class Base {

	use Singleton;

	private $designs;

	private $content_path;

	public function __construct() {
		$this->designs      = include 'designs.php';
		$this->designs      = apply_filters('shopengine/templates/sample-designs', $this->designs);
		$this->content_path = \ShopEngine::core_dir() . 'sample-designs/';

		if(!class_exists('\ShopEngine_Pro')) {

			foreach($this->designs as $tpl => $designs) {

				foreach($designs as $idx => $design) {

					if($design['package'] === 'pro') {

						unset($this->designs[$tpl][$idx]);
					}
				}
			}
		}
	}

	public function get_designs() {
		return $this->designs;
	}

	public function get_design_data($content_file_path) {

		$content_file = $this->content_path . $content_file_path;
		if(file_exists($content_file)) {
			$content = json_decode(file_get_contents($content_file),JSON_UNESCAPED_UNICODE);
			return ($content['content'] ?? null);
		}

		return null;
	}
}
