<?php

namespace ShopEngine\Core\Export_Import;

use ShopEngine\Core\Builders\Action;
use ShopEngine\Core\Builders\Templates;

class Export {

	public function init() {

		add_action('rss2_head', [$this, 'add_options_in_export_file']);
	}

	public function add_options_in_export_file() {

	    $template_types = Templates::get_template_types(); ?>

        <wp_options> <?php

            foreach($template_types as $key => $template_type) {

	            $op_key = Action::PK__SHOPENGINE_TEMPLATE . '__' . $key;
	            $op_val = get_option($op_key, 0);
	            ?>
                <wp_option>
                    <name><?php echo esc_attr($op_key) ?></name>
                    <val><?php echo $op_val ?></val>
                </wp_option>
                <?php
            } ?>

        </wp_options> <?php
    }
}

