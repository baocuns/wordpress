<div class="shopengine-archive-result-count">
	<?php

	\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();

	if(\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview()) { ?>

        <p class="woocommerce-result-count"><?php echo esc_html__('Showing all results', 'shopengine'); ?></p> <?php

	} else {
	    
		woocommerce_result_count();
	} ?>
</div>
