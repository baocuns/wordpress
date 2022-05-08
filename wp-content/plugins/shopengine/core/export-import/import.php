<?php

namespace ShopEngine\Core\Export_Import;

class Import {

	public function init() {

		add_action('import_start', [$this, 'rum_importer']);
	}

	public function rum_importer() {

		if(empty($_POST['import_id'])) {
			return;
		}

		$im_id = (int)$_POST['import_id'];
		$file  = get_attached_file($im_id);

		$dom     = new \DOMDocument;
		$success = $dom->loadXML(file_get_contents($file));

		if(!($success || isset($dom->doctype))) {

			return;
		}

		$xml = simplexml_import_dom($dom);
		unset($dom);

		if(!$xml) {

			return;
		}

		$options = $xml->xpath('/rss/channel/wp_options/wp_option');

		foreach($options as $option) {

			$nm = (string)$option->name;
			$vl = (string)$option->val;

			update_option($nm, $vl);
		}
	}
}
