<?php


namespace ShopEngine\Modules\Comparison;


class Comparison_Cookie {


	public static function remove_product_id( $id ) {
		$product_ids = self::get_product_ids();

		if ( ( $key = array_search( $id, $product_ids ) ) !== false ) {
			unset( $product_ids[ $key ] );
		}
		self::set_comparison_cookie( $product_ids );
	}


	/**
	 * @return array
	 */
	public static function get_product_ids($id = null) {
		if( isset($_COOKIE[ Comparison::COOKIE_KEY ] ) && $_COOKIE[ Comparison::COOKIE_KEY ] ){
			$product_id_from_cookie = $_COOKIE[ Comparison::COOKIE_KEY ] .','.$id;
		}else{
			$product_id_from_cookie =  $id;
		}

		$explode = explode( ',', $product_id_from_cookie );

		foreach ($explode as $key => $id){
			if(!$id || $id == 0){
				unset($explode[$key]) ;
			}
		}

		return array_unique( $explode );
	}

	/**
	 * @param $product_ids array
	 */
	public static function set_comparison_cookie( $product_ids ) {
		$value = implode( ',', $product_ids );
		setcookie( Comparison::COOKIE_KEY, $value, strtotime( '+' . Comparison::COOKIE_TIME_IN_DAYS . ' days' ), '/' );
	}

	public static function add_product_id( $id ) {
		$product_ids = self::get_product_ids();
		array_push( $product_ids, $id );
		self::set_comparison_cookie( $product_ids );
	}

}