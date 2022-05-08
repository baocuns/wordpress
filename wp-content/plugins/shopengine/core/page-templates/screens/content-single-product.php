<?php

defined('ABSPATH') || exit;

do_action('shopengine_woocommerce_before_single_product');

if(post_password_required()) {

	echo get_the_password_form();

	return;
}

?>

<?php if($this->get_page_type_option_slug() == 'quick_view'): ?>
    <style>
        #wpadminbar {
            display: none !important;
        }

        html {
            margin: 0 !important;
        }
    </style>
<?php endif; ?>

<div class="shopengine-quickview-content-warper">

    <div id="product-<?php the_ID(); ?>" <?php post_class('shopengine-product-page'); ?>>
		<?php
			while(have_posts()) : the_post();
				if(\ShopEngine\Core\Builders\Action::is_edit_with_gutenberg($this->prod_tpl_id)) {
					echo do_blocks(get_the_content(null, false, $this->prod_tpl_id));
				}else{
					\ShopEngine\Core\Page_Templates\Hooks\Base_Content::instance()->load_content_designed_from_builder();
				}
			endwhile;
		?>
    </div>
</div>
