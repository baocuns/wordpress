<?php
namespace ShopEngine\Libs\Select_Api;

defined('ABSPATH') || exit;

/**
 * Class Api
 *
 * @package ShopEngine\Core\Builders
 */
class Base extends \ShopEngine\Base\Api {

	public function config() {

		$this->prefix = 'ajaxselect2';
	}

    public function get_post_list(){

        if(!current_user_can('edit_posts')){
         return;   
        }

        $query_args = [
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'posts_per_page'    => 15,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;
        }
        if(isset($this->request['s'])){
            $query_args['s'] = $this->request['s'];
        }

        $query = new \WP_Query($query_args);
        $options = [];
        if($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
            }
        endif;

        return ['results' => $options];
        wp_reset_postdata();
    }
    
    public function get_page_list(){
        if(!current_user_can('edit_posts')){
            return;   
           }
        $query_args = [
            'post_type'         => 'page',
            'post_status'       => 'publish',
            'posts_per_page'    => 15,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;
        }
        if(isset($this->request['s'])){
            $query_args['s'] = $this->request['s'];
        }

        $query = new \WP_Query($query_args);
        $options = [];
        if($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
            }
        endif;

        return ['results' => $options];
        wp_reset_postdata();
    }

    public function get_singular_list(){
        $query_args = [
            'post_status'       => 'publish',
            'posts_per_page'    => 15,
            'post_type' => 'any'
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;
        }
        if(isset($this->request['s'])){
            $query_args['s'] = $this->request['s'];
        }

        $query = new \WP_Query($query_args);
        $options = [];
        if($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
            }
        endif;

        return ['results' => $options];
        wp_reset_postdata();
    }

    public function get_product_list(){
        $query_args = [
            'post_type'         => 'product',
            'post_status'       => 'publish',
            'posts_per_page'    => 15,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;
        }
        if(isset($this->request['s'])){
            $query_args['s'] = $this->request['s'];
        }

        $query = new \WP_Query($query_args);
        $options = [];
        if($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
            }
        endif;

        return ['results' => $options];
        wp_reset_postdata();
    }

    public function get_category(){
        return $this->terms(['category'], true);
    }

    public function get_product_cat(){
        return $this->terms(['product_cat']);
    }

    public function get_product_tags() {
        return $this->terms(['product_tag']);
    }

    public function get_product_pa_list() {

        global $wpdb;

        $search = '';
        if(isset($this->request['s'])) {
            $search = $this->request['s'];
        }

        $query      = "SELECT * FROM {$wpdb->prefix}woocommerce_attribute_taxonomies WHERE attribute_name LIKE '%{$search}%' ORDER BY attribute_name ASC LIMIT 10";
        $attributes = $wpdb->get_results($query);

        $options = [];

        foreach ($attributes as $attribute) {
            $options[] = ['id' => 'pa_' .$attribute->attribute_name, 'text' => $attribute->attribute_label];
        }

        return ['results' => $options];
    }

    /**
     * @param $taxonomies
     * @param $hide_empty
     */
    public function terms($taxonomies, $hide_empty = false) {
        $query_args = [
            'taxonomy'      => $taxonomies, // taxonomy name
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => $hide_empty,
            'number'        => 10
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['include'] = $ids;
        }
        if(isset($this->request['s'])){
            $query_args['name__like'] = $this->request['s'];
        }

        $terms = get_terms( $query_args );


        $options = [];

        if(is_countable($terms) && count($terms) > 0):
            foreach ($terms as $term) {
                $options[] = [ 'id' => $term->term_id, 'text' => $term->name ];
            }
        endif;

        return ['results' => $options];
    }
}