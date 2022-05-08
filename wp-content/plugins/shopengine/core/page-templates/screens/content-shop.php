<?php

do_action('shopengine/woocommerce/main-content/shop-template');


if(\ShopEngine\Core\Builders\Action::is_edit_with_gutenberg($this->prod_tpl_id)) {
	echo do_blocks(get_the_content(null, false, $this->prod_tpl_id));
}else{
	\ShopEngine\Core\Page_Templates\Hooks\Base_Content::instance()->load_content_designed_from_builder();
}