<?php defined('ABSPATH') || exit;

// return if review not available
$is_editor = ($post_type == \ShopEngine\Core\Template_Cpt::TYPE) ? true : false;
$rating_count = $product->get_rating_count();

if(!$is_editor && (!post_type_supports('product', 'comments') || !wc_review_ratings_enabled() || $rating_count <= 0 || !function_exists('woocommerce_template_single_rating'))) {

	return;
}

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter_by_match('woocommerce/single-product/rating.php', 'templates/single-product/rating.php');

?>

<div class="shopengine-product-rating">

	<?php if($is_editor) : ?>

		<div class="woocommerce-product-rating">
			<?php echo wc_get_rating_html( 3.5, 10 ); // WPCS: XSS ok. ?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">
				(<?php printf( _n( '%s customer review', '%s customer reviews', 10, 'shopengine' ), '<span class="count">' . esc_html( 10 ) . '</span>' ); ?>)
			</a>
		</div>

	<?php else :
		
		woocommerce_template_single_rating();
		
	endif; ?>
	
</div>
