<?php /**
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 *
 * wp-content/plugins/woocommerce/templates/cart/cart-empty.php
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="shopengine-empty-cart-message">
	<?php
	if(!empty(WC()->cart) && WC()->cart->is_empty()) {

		if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<p class="cart-empty woocommerce-info"><?php esc_html_e( 'No products added to the cart', 'shopengine' ); ?></p>
		<?php endif;

	} elseif(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) { 
		?>
			<div class="shopengine shopengine-editor-alert shopengine-editor-alert-warning">
				<?php esc_html_e('There are products in your cart, please go to cart, clear it and refresh the editor.', 'shopengine'); ?>
			</div>
        <?php
    }
	?>
</div>
