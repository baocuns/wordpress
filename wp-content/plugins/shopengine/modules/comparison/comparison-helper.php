<?php


namespace ShopEngine\Modules\Comparison;


use ShopEngine\Core\Register\Module_List;
use ShopEngine\Utils\Helper;

class Comparison_Helper {

	public static function get_html($content = [], $comparison_page =  false) {

		if(empty($content)) {
			return '<h1 class="shopengine-no-comparison-product">'.esc_html__('No product is added for comparison, please add some product to compare', 'shopengine').'</h1>';
		}

		$settings       = Module_List::instance()->get_active_settings( 'comparison' );
		$attributes_fields = $settings['attribute_fields']['value'] ?? [] ;

		$default_fields = [ 'url', 'image', 'price' ];
		if( class_exists('ShopEngine_Pro') ) {
			$default_fields['attributes']   = $attributes_fields;
        }

		$fields = array_merge($default_fields, $settings['shop_field_in_table']['value'] ?? []);

		$fields['attributes'] = $attributes_fields;

		$share_buttons = $settings['share_button']['value'] ?? [];

		$field_value_manager =  new Comparison_Field_Value();
		$field_value_manager->product_ids =   $content;

		$displayable_fields = [];

		foreach ( $content as $pid ) {
			if ( empty( $pid ) ) {
				continue;
			}

			$product = wc_get_product( $pid );
			if( $product->get_status() !== 'publish' ) {
			    continue;
			}


			if ( empty( $product ) ) {
				continue;
			}

			foreach ( $fields as $key => $field ) {

                if(gettype($field) != 'string'){
                   $slug = $key;
                }else{
	                $slug =  $field ;
                }

				$displayable_fields[ $slug ][ $pid ] = $field_value_manager->get_value( $product,
					$slug, $field );
			}
		}

		$format_attributes = [];
		foreach ($displayable_fields['attributes'] as $product_id => $attribute_data){

                foreach ($attribute_data[$product_id] as $key => $attributes){
	                $format_attributes[$key][$product_id] = $attributes;
                }
        }

		$displayable_fields['attributes'] = $format_attributes;

		// group first tr values
		$first_tr = [];
		$first_tr['first_tr']['url'] = $displayable_fields['url'] ?? [];
		$first_tr['first_tr']['image'] = $displayable_fields['image'] ?? [];
		$first_tr['first_tr']['title'] = $displayable_fields['title'] ?? [];
		$first_tr['first_tr']['price'] = $displayable_fields['price'] ?? [];

		$displayable_fields = $first_tr + $displayable_fields ;
		if( class_exists('ShopEngine_Pro') ) {
			$displayable_fields['custom_meta'] = $settings['custom_meta_fields']['value'] ?? [];
		}

		unset($displayable_fields['url'], $displayable_fields['image'], $displayable_fields['title'], $displayable_fields['price']);

		?>
		<div class="shopengine-modal-wrap">
			<div class="shopengine-comparison-container">
				<div class="shopengine-comparison">
					<h2><?php echo esc_html__('Product comparison', 'shopengine') ?> </h2>

					<?php if( class_exists('ShopEngine_Pro') && $share_buttons ) : ?>
						<div class="social-share">
							<?php
							$share_url = home_url( '?comparison=yes&product_ids=' . implode( ',', $content ) );

							foreach ( $share_buttons as $share_button ) {
								switch ( $share_button ) {
									case 'facebook':
										echo sprintf(
											'<a href="%1$s" target="_blank" target="_blank"><i class="eicon-facebook"></i> <span>%2$s</span></a>',
											'https://www.facebook.com/sharer.php?u=' . $share_url,
											esc_html__('Share on Facebook', 'shopengine')
										);
										break;
									case 'twitter':
										echo sprintf(
											'<a href="%1$s" target="_blank" target="_blank"><i class="eicon-twitter"></i> <span>%2$s</span></a>',
											'https://twitter.com/intent/tweet?url=' . $share_url,
											esc_html__('Share on Twitter', 'shopengine')
										);
										break;
									case 'copy_url':
										echo sprintf(
											'<a href="#" class="copy-comparison-share-url" data-share-url="%1$s" data-message="%2$s"> <i class="eicon-copy"></i> <span>%3$s</span> </a>',
											$share_url,
											esc_html__('Copied', 'shopengine'),
											esc_html__('Copy', 'shopengine')
										);
										break;
								}
							}
							?>
						</div>
					<?php endif;?>

					<div class="comparison-table-wrap">
						<table class="table table-bordered <?php echo $comparison_page ? 'comparison-page' : '' ?>">
							<tbody> <?php

							foreach ($displayable_fields as $slug => $data){
								$field_value_manager->get_html($slug, $data);
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function generate_meta_keys_array( $keys ) {
		/*$cache = get_transient( 'shopengine-all-products_meta_keys_array' );
		if($cache){
		  	return $cache;
		}*/

		$keys_array = [];
		foreach ( $keys as $key ) {
		   $title = ucwords( preg_replace( '~([^a-z0-9\-])~i', ' ', $key ) );
			$keys_array[ $key ] = $title;
		}

	 //	set_transient( 'shopengine-all-products_meta_keys_array', $keys_array, 60 * 60 * 0.01 );

		return $keys_array;
	}

	public static function get_products_meta_keys() {
		return static::generate_meta_keys_array(Helper::get_products_meta_keys());
	}


}