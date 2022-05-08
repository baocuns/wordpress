<?php defined('ABSPATH') || exit; 

$category_ids   = (isset($shopengine_product_cat_lists_cats) && !empty($shopengine_product_cat_lists_cats)) ? $shopengine_product_cat_lists_cats : [];
?>

<div class="shopengine-product-category-lists">

    <?php if($category_ids) : ?>

        <div class="shopengine-category-lists-grid">

            <?php  foreach($category_ids as $key => $category_id) :

                $term = get_term($category_id, 'product_cat');
                $thumbnail_id   = get_term_meta($category_id, 'thumbnail_id', true);
                if($thumbnail_id && isset($shopengine_product_cat_lists_show_cat_image) && $shopengine_product_cat_lists_show_cat_image === 'yes'){
                    $image_url = wp_get_attachment_url( $thumbnail_id );
                    $this->add_render_attribute( 'wrap-' . $key, 'style', 'background-image: url(' . esc_url($image_url) . ')' );
                }
                
                if(!empty($term)) : ?>

                    <div class="single-cat-list-item" <?php echo $this->get_render_attribute_string( 'wrap-' . $key ); ?>>
                        <div class="product-category-wrap">
                            <div class="single-product-category">
                                <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                    <h3 class="product-category-title">
                                        <?php echo esc_html($term->name); ?>
                                    </h3>

                                    <?php if(isset($shopengine_product_cat_lists_show_count) && $shopengine_product_cat_lists_show_count =='yes') : ?>
                                        <p class="cat-count">
                                            <?php echo sprintf( _n( '%s product', '%s products', $term->count, 'shopengine' ), $term->count ); ?>
                                        </p>
                                    <?php endif;
                                    
                                    if(isset($shopengine_product_cat_lists_show_icon) && $shopengine_product_cat_lists_show_icon == 'yes') : ?>
                                        <span class="cat-icon">
                                            <?php \Elementor\Icons_Manager::render_icon($shopengine_product_cat_lists_icon, ['aria-hidden' => 'true']); ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                                <!-- dot shap -->
                            </div> 
                        </div>
                    </div>
                    
                <?php endif;

            endforeach; ?>

        </div>

    <?php else :
    
        esc_html_e('Add some category', 'shopengine');

    endif; ?>

</div>
