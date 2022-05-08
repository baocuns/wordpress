<?php

namespace Elementor;

defined('ABSPATH') || exit;

class ShopEngine_Product_List_Config extends \ShopEngine\Base\Widget_Config{

    public function get_name() {
		return 'product-list';
	}


	public function get_title() {
		return esc_html__('Product List', 'shopengine');
	}


	public function get_icon() {
		return 'shopengine-widget-icon shopengine-icon-archive_products';
	}


	public function get_categories() {
		return ['shopengine-archive'];
	}


	public function get_keywords() {
		return ['woocommerce', 'shopengine', 'product', 'product list'];
	}

	public function get_template_territory() {
		return [];
	}

	public function product_order_by() {

        if (class_exists('ShopEngine_Pro')) {
            return [
                'ID'            => esc_html__('ID', 'shopengine'),
                'title'         => esc_html__('Title', 'shopengine'),
                'name'          => esc_html__('Name', 'shopengine'),
                'date'          => esc_html__('Date', 'shopengine'),
                'comment_count' => esc_html__('Popular', 'shopengine'),
                'modified'      => esc_html__('Modified', 'shopengine'),
                'price'         => esc_html__('Price', 'shopengine'),
                'sales'         => esc_html__('Sales', 'shopengine'),
                'rated'         => esc_html__('Top Rated', 'shopengine'),
                'rand'          => esc_html__('Random', 'shopengine'),
                'menu_order'    => esc_html__('Menu Order', 'shopengine'),
                'sku'           => esc_html__('SKU', 'shopengine'),
                'stock_status'  => esc_html__('Stock Status', 'shopengine')
            ];
        }
        return [
            'ID'            => esc_html__('ID', 'shopengine'),
            'title'         => esc_html__('Title', 'shopengine'),
            'name'          => esc_html__('Name', 'shopengine'),
            'date'          => esc_html__('Date', 'shopengine'),
            'comment_count' => esc_html__('Popular', 'shopengine')
        ];
    }

    public function product_query_by() {

        if (class_exists('ShopEngine_Pro')) {
            return [
                'category'  => esc_html__('Category', 'shopengine'),
                'tag'       => esc_html__('Tag', 'shopengine'),
                'product'   => esc_html__('Product', 'shopengine'),
                'rating'    => esc_html__('Rating', 'shopengine'),
                'attribute' => esc_html__('Attribute', 'shopengine'),
                'author'    => esc_html__('Author', 'shopengine'),
				'featured' => esc_html__('Featured', 'shopengine'),
				'sale'     => esc_html__('Sale', 'shopengine'),
				'viewed'   => esc_html__('Recently Viewed', 'shopengine')
            ];
        }
        return [
            'category'  => esc_html__('Category', 'shopengine'),
			'tag'       => esc_html__('Tag', 'shopengine'),
			'product'   => esc_html__('Product', 'shopengine'),
			'rating'    => esc_html__('Rating', 'shopengine'),
			'attribute' => esc_html__('Attribute', 'shopengine'),
			'author'    => esc_html__('Author', 'shopengine'),
        ];
    }

}