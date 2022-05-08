<?php

namespace ShopEngine\Core\Builders;

use ShopEngine\Core\PageTemplates\Page_Templates;

class Templates {

	const BODY_CLASS = 'shopengine-template';

	public static function get_template_types(): array {

		return Page_Templates::instance()->getTemplates();
	}

	public static function get_registered_template_data($template_id) {

		$type = self::get_template_type_by_id($template_id);

		return Page_Templates::instance()->getTemplate($type);
	}

	public static function get_template_type_by_id($pid): string {

		$pm = get_post_meta($pid, Action::get_meta_key_for_type(), true);

		return empty($pm) ? 'shop' : $pm;
	}

	public static function get_registered_template_id($template_type, $category = '') {

		if(!empty($_GET['change_template']) && !empty($_GET['shopengine_template_id']) && !empty($_GET['preview_nonce'])) {
			
			$nonce_status = apply_filters(
				'shopengine/demo/bypass_nonce', 
				(wp_verify_nonce($_GET['preview_nonce'], 'template_preview_' . $_GET['shopengine_template_id']))
			);

			if(1 !== $nonce_status) {
				return 0;
			}

			return (int)$_GET['shopengine_template_id'];
		}

		global $wpdb;

		if (class_exists(\ShopEngine_Pro::class)) {

            if (is_archive() && !is_shop()) {

                $category = get_queried_object();

                $category_id = isset($category->term_id) ? $category->term_id : false;

                if ($category_id) {

                    $parent_categories = get_ancestors($category_id, 'product_cat');

                    if (!empty($parent_categories)) {
                        $category_id = $parent_categories[0];
                    }

                    $saved_template_id = get_option(Action::PK__SHOPENGINE_TEMPLATE . '__' . $template_type . '__' . $category_id, 0);

                    if ($saved_template_id != 0) {

                        $templates = $wpdb->get_results("select ID from $wpdb->posts where post_type = 'shopengine-template' and ID = '$saved_template_id' and post_status = 'publish'", ARRAY_A);
						
						if(isset($templates[0])) {
							return (int) $saved_template_id;
						}
                    }
                }

            } elseif (is_product()) {

                $terms = wc_get_product_terms(wc_get_product()->get_id(), 'product_cat', ['orderby' => 'parent', 'order' => 'DESC']);

                if (!empty($terms)) {

                    $category_id       = $terms[0]->parent !== 0 ? $terms[0]->parent : $terms[0]->term_id;
                    $saved_template_id = get_option(Action::PK__SHOPENGINE_TEMPLATE . '__' . $template_type . '__' . $category_id, 0);

                    if ($saved_template_id != 0) {

                        $templates = $wpdb->get_results("select ID from $wpdb->posts where post_type = 'shopengine-template' and ID = '$saved_template_id' and post_status = 'publish'", ARRAY_A);
						
						if(isset($templates[0])) {
							return (int) $saved_template_id;
						}
                    }
                }
            }
        }

        return (int) get_option(Action::PK__SHOPENGINE_TEMPLATE . '__' . $template_type, 0);
	}

    public static function has_simple_product($in_status = ['publish', 'draft'])
    {
        global $wpdb;

        $result = $wpdb->get_row("
    SELECT * 
    FROM  $wpdb->posts
        WHERE post_type = 'product'
         AND post_status IN('publish', 'draft')
   ");

        return ! empty($result);
    }

    public static function create_wc_simple_product() {

		$product = new \WC_Product_Simple();

		$product->set_name( 'Shopengine preview product [do not delete it]' );
		$product->set_description( 'This is a shopengine demo preview product' );
		$product->set_short_description( 'This is a shopengine demo preview product' );
		$product->set_status( 'draft' );

		$product->set_regular_price( 100 );
		$product->set_sale_price( 79 );
		$product->set_price( 79 );

		$product->set_sku( 'shopengine-demo-preview-01' );

		$product->set_manage_stock( false );
		$product->set_stock_status( 'instock' );

		$product->set_weight( 11 );
		$product->set_length( 12 );
		$product->set_width( 10 );
		$product->set_height( 9 );

		//$product->set_image_id( 'image_id' );
		//$product->set_gallery_image_ids( [] );

		return $product->save();
	}
}
