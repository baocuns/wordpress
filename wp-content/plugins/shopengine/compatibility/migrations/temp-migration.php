<?php

namespace ShopEngine\Compatibility\Migrations;

use ShopEngine\Core\Builders\Action;
use ShopEngine\Core\Template_Cpt;

class Temp_Migration {

	const MIGRATION_KEY = 'mig_1_1_3_to_1_2_0';

	public function init() {

		$opt = get_option(self::MIGRATION_KEY, '');

		if(!empty($opt)) {

			// migration is done already

			return;
		}

		$this->update_elementor_template_type();

		update_option(self::MIGRATION_KEY, date('Y-m-d H:i:s'));
	}

	protected function update_elementor_template_type() {

		$args = [
			'post_type'      => Template_Cpt::TYPE,
			'posts_per_page' => -1,
		];

		$all_posts = get_posts($args);

		$pid = [];

		if($all_posts) {
			foreach($all_posts as $post) {

				$pid[] = $post->ID;

				$pm = get_post_meta($post->ID, '_wp_page_template', true);
				$type = get_post_meta($post->ID, Action::get_meta_key_for_type(), true);

				if(in_array($type, ['quickview', 'quickcheckout'])) {

					update_post_meta($post->ID, '_wp_page_template', 'elementor_canvas');

				} elseif($pm == 'elementor_canvas') {

					update_post_meta($post->ID, '_wp_page_template', 'elementor_header_footer');
				}
			}
		}
	}
}
