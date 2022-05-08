<?php


namespace ShopEngine\Modules\Comparison;


use ShopEngine\Modules\Swatches\Helper;
use ShopEngine\Modules\Swatches\Swatches;

class Group_Meta {


	public function index(\WC_Product $product){

		if( $product->get_status() !== 'publish' ){
			return false;
		}

		$product_id = $product->get_id();

		$formatted_attributes[ $product_id ] = [];

		if ( $product->has_attributes() ) {
			$attributes = $product->get_attributes();

			foreach ( $attributes as $attribute ) {
				$attribute_id = $attribute->get_name();

				$assigned_terms = $attribute->get_options();

				$formatted_attributes[ $product_id ][ $attribute_id ]['name']       = wc_attribute_label( $attribute->get_name() );
				$formatted_attributes[ $product_id ][ $attribute_id ]['plain_name'] = $attribute->get_name();
				$formatted_attributes[ $product_id ][ $attribute_id ]['taxonomy']   = '';

				if ( $attribute->is_taxonomy() ) {
					$txo_meta = Helper::get_tax_attribute( $attribute->get_name() );

					$formatted_attributes[ $product_id ][ $attribute_id ]['taxonomy'] = $txo_meta->attribute_type;

					foreach ( $assigned_terms as $assigned_term ) {
						$term = get_term_by( 'id', $assigned_term, $attribute->get_name() );

						if ( $txo_meta->attribute_type === Swatches::PA_COLOR ) {
							$t_val = get_term_meta( $assigned_term, 'shopengine_color', true );

							$formatted_attributes[ $product_id ][ $attribute_id ]['taxonomy_value'][ $assigned_term ] = $t_val;
						}

						$formatted_attributes[ $product_id ][ $attribute_id ]['value'][] = $term->name;
					}
				} else {
					foreach ( $assigned_terms as $term ) {
						$formatted_attributes[ $product_id ][ $attribute_id ]['value'][] = $term;
					}
				}
			}
		}

	     //die(json_encode($formatted_attributes));

		return $formatted_attributes;

	}


}