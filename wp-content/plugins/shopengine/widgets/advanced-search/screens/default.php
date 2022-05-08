<?php $cats = ShopEngine\Utils\Helper::category_list_by_taxonomy('product_cat'); ?>
<?php

$category_id = '';

if(is_archive() && !is_shop() && !is_product_tag()) {
    $category = get_queried_object();
    $category_id = isset($category->term_id) ? $category->term_id : '';
}

?>
<div class="shopengine-advanced-search">
    <form method="GET" action="<?php echo get_rest_url(null, 'shopengine/v1/advanced-search'); ?>/"
          class="shopengine-search-form">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('wp_rest'); ?>"/>
        <input type="hidden" name="post_type" value="product"/>

        <div class="search-input-group">

            <!-- search button -->
            <button type="submit" class="search-btn">
				<?php \Elementor\Icons_Manager::render_icon($settings['shopengine_advanced_search_icon'], ['aria-hidden' => 'true']); ?>

				<?php if(!empty($settings['shopengine_advanced_search_text'])) : ?>
                    <span class="shopengine-search-text"><?php echo esc_html($settings['shopengine_advanced_search_text']); ?></span>
				<?php endif; ?>
            </button>
            <!-- search input -->
            <input type="search" name="s" class="shopengine-advanced-search-input"
                   placeholder="<?php echo esc_attr__('Search for Products...', 'shopengine'); ?>">

            <!-- search category -->
            <div class="shopengine-category-select-wraper">
                <select class="shopengine-ele-nav-search-select" name="product_cat">
                    <option value=""><?php echo !empty($settings['shopengine_advanced_search_title_all']) ? $settings['shopengine_advanced_search_title_all'] : ''; ?></option>
					<?php if(is_array($cats) && !empty($cats)): ?>
						<?php foreach($cats as $cat) { ?>
                            <option
                                    <?php selected($category_id, $cat->term_id); ?>
                                    class="<?php echo esc_attr($cat->category_parent !== 0 ? 'child-category' : '') ?>"
                                    value="<?php echo esc_attr($cat->term_id); ?>">
								<?php echo esc_html($cat->name); ?>
                            </option>
						<?php } ?>
					<?php endif; ?>
                </select>
            </div>

        </div>

        <div class="shopengine-search-result-container">
            <div class="shopengine-search-result">

            </div>
        </div>

    </form>
</div>
