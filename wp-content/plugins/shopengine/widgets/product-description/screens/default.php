<?php
// Editor Mode Check.
$in_editor_mode = \ShopEngine\Core\Template_Cpt::TYPE == get_post_type();
?>
<div class="shopengine-product-description">
	<?php
		// Show only in the Editor and Preview Mode.
		if ( $in_editor_mode ):
			$product = \ShopEngine\Widgets\Products::instance()->get_product(get_post_type());
			echo \ShopEngine\Utils\Helper::render($product->get_description());
				
		else: // Show in the Frontend.
			the_content();

		endif;
	?>
</div>
