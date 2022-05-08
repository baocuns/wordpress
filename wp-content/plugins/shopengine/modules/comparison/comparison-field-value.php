<?php


namespace ShopEngine\Modules\Comparison;


use ShopEngine\Core\Register\Module_List;
use ShopEngine\Modules\Swatches\Helper;
use ShopEngine\Modules\Swatches\Swatches;
use WC_Product;

class Comparison_Field_Value {

    public $product_ids = [] ;
	private $generated_attributes = [];

	public function get_value( WC_Product $product, $slug , $data = null) {

		return $this->set_value( $product, $slug, $data);
	}

	private function set_value( WC_Product $product, $slug, $data = null) {
		switch ( $slug ) {
			case 'url':
				return $product->add_to_cart_url();
			case 'image':
				return $product->get_image();
			case 'title':
				return $product->get_title();
			case 'price':
				$price['regular'] = $product->get_regular_price();
				$price['sale']    = $product->get_sale_price();
				$price['price']   = $product->get_price();
				$price['htm']     = $product->get_price_html();

				return $price;
			case 'description':
				return $product->get_description();
			case 'availability':
				return $product->get_stock_status();
			case 'sku':
				return $product->get_sku();
			case 'weight':
				return $product->get_weight();
			case 'dimension':
				return $product->get_dimensions( false );
			case 'attributes':
				return $this->get_attributes( $product, $data );
			case 'height':
				return $product->get_height();
		}

		return '';
	}

	public function get_attributes( WC_Product $product , $data = null) {

	    if(!$data) $data = [] ;

		$formatted_attributes[$product->get_id()] = [];

		if ( $product->has_attributes() ) {

			$attributes = $product->get_attributes();
			foreach ( $attributes as $attribute ) {
				$attribute_name = wc_attribute_label( $attribute->get_name() );
				$attribute_slug = strtolower(str_replace(' ', '_', $attribute_name));
				if(in_array($attribute_slug, $data)){
					$formatted_attributes[$product->get_id()][$attribute_slug] = explode(', ', $product->get_attribute( $attribute_name ) );
                }
			}

		}

		return $formatted_attributes;
	}

	public function get_html( $slug, $data ) {
		switch ( $slug ) {
			case 'first_tr':
				?>
                <tr>
                    <th style="vertical-align: middle;">  <?php
						esc_html_e( 'Product Name', 'shopengine' ) ?> </th>
					<?php
					$this->print_first_tr( $data ); ?>
                </tr>


				<?php
				break;
			case 'attributes':

			 foreach ($data as $slug => $attributes ){

				?>
                <tr>
                    <th style="vertical-align: middle;">  <?php
						echo $slug ?> </th>
					<?php
					$this->print_attributes( $slug, $attributes ); ?>
                </tr>
				<?php
             }
				break;
			case 'custom_meta':

			 foreach ($data as $meta ){

				?>
                <tr>
                    <th style="vertical-align: middle;">  <?php
						echo ucwords( preg_replace( '~([^a-z0-9\-])~i', ' ', $meta ) ) ?> </th>
					<?php
					$this->print_custom_meta( $meta ); ?>
                </tr>
				<?php
             }
				break;
			case 'color':
				?>
                <tr>
                    <th style="vertical-align: middle;">  <?php
						echo ucwords( str_replace( '_', ' ', $slug ) ) ?> </th>
					<?php
					$this->print_color_attribute( $slug, $data ); ?>
                </tr>
				<?php
				break;
			default:

				?>
                <tr>
                    <th style="vertical-align: middle;">  <?php
						echo ucwords( str_replace( '_', ' ', $slug ) ) ?> </th>
					<?php
					$this->print_tr( $slug, $data ); ?>
                </tr>
				<?php
				break;
		}
	}

	public function get_add_to_cart( WC_Product $product , $args = array() ) {

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'compare-cart-btn',
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}

			echo apply_filters(
				'woocommerce_modal_add_to_cart_link', // WPCS: XSS ok.
				sprintf(
					'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
					esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
					isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
					esc_html( $product->add_to_cart_text() )
				),
				$product,
				$args
			);
		}
	}

	private function print_first_tr( $data ) {
		foreach ( $data['image'] as $product_id => $datum ) {
			$product = wc_get_product( $product_id );
			 ?>
			<td class="first--row">
				<?php
				echo sprintf( '<a class="shopengine-remove-action badge-comparison" data-pid="%s"><i class="eicon-close"></i> %s</a>', esc_attr( $product_id ), esc_html__( 'Remove', 'shopengine' ) );
				echo $datum;
				echo isset($data['title'][ $product_id ]) ? '<h4>'.$data['title'][ $product_id ].'</h4>': '';
				echo isset($data['price'][ $product_id ]['htm']) ? '<div>'.$data['price'][ $product_id ]['htm'].'</div>': '';
				?>
				<div class="comparison-add-to-cart">
					<?php $this->get_add_to_cart( $product );?>
				</div>
			</td>
			<?php
		}
	}

	private function print_attributes( $slug, $data) {

	    if(!$data) $data = [];
		foreach ( $data as $product_id => $attribute ) {
			?>
            <td class="first--row">
				<?php
					foreach ( $attribute as $value ) {
						echo '<span class="comparison-attribute-badge">' . $value . '</span> ';
					}
				?>
            </td>

			<?php
		}

		$need_tds = count($this->product_ids) - count($data);

		for ($x = 1; $x <= $need_tds; $x++) {
			echo '<td class="first--row"></td>';
		}

	}

	private function print_custom_meta( $slug) {

		foreach ($this->product_ids as $product_id) {
		    if($product_id) {
			    $meta_value = get_post_meta( $product_id, $slug, true );

			    echo '<td class="first--row">';

			    if ( gettype( $meta_value ) == 'array' ) {
				    foreach ( $meta_value as $value ) {
					    echo '<span class="comparison-meta-badge" > ' . $value . '</span> ';
				    }
			    } else {
				    echo get_post_meta( $product_id, $slug, true );
			    }

			    echo '</td>';
		    }
		}

	}

	private function print_color_attribute( $slug, $data ) {
		foreach ( $data as $product_id => $datum ) {
			?>
            <td class="first--row">
				<?php

				foreach ( $datum as $attribute ) {
					foreach ( $attribute['value'] as $value ) {
						echo '<span class="comparison-color-badge" style="background-color:' . $value . '"></span> ';
					}
				}
				?>
            </td>

			<?php
		}
	}

	private function print_tr( $slug, $data ) {
		foreach ( $data as $product_id => $datum ) {
			if ( $slug == 'dimension' ) {
				$datum = wc_format_dimensions( $datum );
			}
			?>
            <td class="first--row">
				<?php
				echo $datum ?>
            </td>

			<?php
		}
	}

}