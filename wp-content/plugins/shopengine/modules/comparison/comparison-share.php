<?php


namespace ShopEngine\Modules\Comparison;


class Comparison_Share {

	public static function init() {
		$product_ids = isset( $_GET['product_ids'] ) &&  $_GET['product_ids'] ? explode( ',', $_GET['product_ids'] ?? '' ) : [];

		if ( empty( $product_ids ) ) {
			$existing_comparison_products = empty( $_COOKIE[ Comparison::COOKIE_KEY ] ) ? '' : $_COOKIE[ Comparison::COOKIE_KEY ];
			$product_ids                  = $existing_comparison_products? explode( ',', $existing_comparison_products ) : [];

		} else {
			setcookie(
				Comparison::COOKIE_KEY,
				implode( ',', $product_ids ),
				strtotime( '+' . Comparison::COOKIE_TIME_IN_DAYS . ' days' ), '/'
			);
		}

		get_header();
		?>
		<div class="shopengine-comparison-page">
			<div class="comparison-page-inner">
				<?php
				if ( empty( $product_ids ) ) {
					echo '<h1 class="shopengine-no-comparison-product">' . esc_html__( 'No product is added for comparison, please add some product to compare', 'shopengine' ) . '</h1>';
				} else {
					Comparison_Helper::get_html( $product_ids, true );
				}
				?>
			</div>
		</div>
		<?php get_footer();
	}

}