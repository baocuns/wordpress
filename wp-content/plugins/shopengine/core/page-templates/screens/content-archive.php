<?php

do_action('shopengine/woocommerce/main-content/shop-template');

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing div for the content)
 */
if(\ShopEngine\Core\Builders\Action::is_edit_with_gutenberg($this->prod_tpl_id)) {
	echo do_blocks(get_the_content(null, false, $this->prod_tpl_id));
}else{
	\ShopEngine\Core\Page_Templates\Hooks\Base_Content::instance()->load_content_designed_from_builder();
}
