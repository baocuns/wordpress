
<div class="shopengine-filterable-product-wrap">
    <?php
        $uid        = [];
        $products   = [];
        $count      = 0;
    ?>
    <!-- -----------------------
    Filterable product navbar
    ------------------------- -->
    <div class="filter-nav">
        <ul>
            <?php if(!empty($settings['filter_content'])) : foreach($settings['filter_content'] as $key => $content) :
                
                // collect navbar label
                array_push( $uid, uniqid() );
                
                if($key == 0){
                    //collect all the products id added inito a nav item
                    $products = $content['product_list'];
                }
            ?>
            <li class="filter-nav-item">
                <a  href="#" 
                    class="filter-nav-link <?php echo esc_attr($key == 0 ? 'active' : ''); ?>" 
                    data-filter-uid="<?php echo esc_attr( $uid[$count] ); ?>" 
                    data-product-list='<?php echo !empty($content['product_list']) ? json_encode($content['product_list']) : ''; ?>'>
                    <?php echo esc_html($content['filter_label']); ?>
                </a>
            </li>

            <?php $count++; endforeach; endif; ?>
        </ul>
    </div>

    <!-- -----------------------
    Filterable product content
    ------------------------- -->
    <div class="filter-content">
        <div class="filter-content-row filtered-product-list active <?php  echo !empty($uid) ?  'filter-'.esc_attr($uid[0])  : '' ?>">
            <?php

                /*
                    -------------------------
                    arguments for the query
                    -------------------------
                */ 

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 6,
                    'order'          => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
                    'post__in'  => $products,
                    'orderby'        => isset($settings['product_orderby']) ? $settings['product_orderby'] : 'date'
                );
                
                // query start
                $query = new WP_Query($args);
                $content =  isset($settings['shopengine_custom_ordering_list']) ? $settings['shopengine_custom_ordering_list'] : [];

                if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                                
                    ?>
                    <div class='shopengine-single-product-item'>
                        <?php
                            foreach($content as $key => $value){
                                if(
                                    ($settings['shopengine_is_cats'] !== 'yes' && $value['list_key'] == 'category') ||
                                    ($settings['shopengine_is_details'] !== 'yes' && $value['list_key'] == 'description') ||
                                    ($settings['shopengine_is_product_rating'] !== 'yes' && $value['list_key'] == 'rating')
                                ) { continue; }
                                $function = '_product_' . $value['list_key'];
                                \ShopEngine\Utils\Helper::$function($settings);
                            }
                        ?>
                        
                    </div>
                <?php endwhile; endif; wp_reset_postdata(); 

            ?>
        </div>
    </div>
</div>