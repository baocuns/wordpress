<?php
   $args = array(
         'post_type' => 'product',
         'status'    => 'publish',
         'meta_query' => array(
             array(
                 'key'     => '_sale_price_dates_to',
                 'value' => time(),
                 'compare' => '>'
             ),
             array(
                 'key'     => '_sale_price',
                 'value' => 0,
                 'compare' => '>'
             ),
         ),
         'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 4,
         'order'          => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
         'orderby'        => isset($settings['product_orderby']) ? $settings['product_orderby'] : 'date',
   );

   $query = new WP_Query($args);
   $post_type = get_post_type();

?>

<div class="shopengine-widget">
<div class="shopengine-deal-products-widget">
   <div class="deal-products-container">
      <?php 

         if($query->have_posts()): while($query->have_posts()): $query->the_post(); 

         $id         = get_the_ID();
         $title      = wp_trim_words( get_the_title(),  $settings['title_word_limit'] , '...' );
         $image_url  = get_the_post_thumbnail_url( $id );
         $product    = wc_get_product( $id );

         $price      = wc_price( $product->get_price() );
         $reg_price  = wc_price( $product->get_regular_price() );
         $stock_qty  = $product->get_stock_quantity();
         $total_sell = $product->get_total_sales();
         $available  = $stock_qty  ;
         $offPercentage = 100 ;
         if( $product->get_regular_price() > 0 ) {
            $offPercentage = $product->get_price() /  $product->get_regular_price() * 100;
         }

         $sales_price_from = get_post_meta( $id, '_sale_price_dates_from', true );
         $sales_price_to   = get_post_meta( $id, '_sale_price_dates_to', true );
         $current_time     = strtotime(date('Y-m-d H:i:s')); // get the current time
         $is_time_over     = ($sales_price_to -  $current_time) < 0 ? true : false;

         // when time is over, hide the deal product form the list 
         if ( $is_time_over ) continue;

         // when woo commerce date form value not found it will take the date when the post was created
         if( !isset( $sales_price_from ) || empty( $sales_price_from ) ){
            $sales_price_from = strtotime(get_the_date());
         }

         // data for countdown clock
         $deal_data = [
            'start_time'   => date('Y-m-d H:i:s',$sales_price_from),
            'end_time'     => date('Y-m-d H:i:s',$sales_price_to),
            'show_days'    => ( $settings['shopengine_show_countdown_clock_days'] === 'yes' ) ? 'yes' : 'no' ,
         ];
      

         // options for sell and available section
         $progress_data = [
            'bg_line_clr'     => (isset($settings['shopengine_product_stock_bg_line_clr'])) ? $settings['shopengine_product_stock_bg_line_clr'] : '#F2F2F2',
            'bg_line_height'  => (isset($settings['shopengine_product_stock_bg_line_height']['size'])) ? $settings['shopengine_product_stock_bg_line_height']['size'] : 2,
            'bg_line_cap'     => (isset($settings['shopengine_product_stock_line_cap'])) ? $settings['shopengine_product_stock_line_cap'] : 'round', // "butt|round|square"

            'prog_line_clr'   => (isset($settings['shopengine_product_stock_prog_line_clr'])) ? $settings['shopengine_product_stock_prog_line_clr'] : '#F03D3F',
            'prog_line_height'=> (isset($settings['shopengine_product_stock_prog_line_height']['size'])) ? $settings['shopengine_product_stock_prog_line_height']['size'] : 4,
            'prog_line_cap'   => (isset($settings['shopengine_product_stock_line_cap'])) ? $settings['shopengine_product_stock_line_cap'] : 'round',

            'stock_qty'       => $stock_qty,
            'total_sell'      => $total_sell
         ];

      ?>

      <div class="deal-products" data-deal-data='<?php echo json_encode($deal_data) ?>'>
         
         <div class="deal-products__top">
            <!-- product image -->
            <img class="deal-products__top--img" src="<?php echo esc_url( $image_url ) ?>">
            
            <!-- offer show in percentage -->
            <?php if($settings['shopengine_show_percentage_badge'] === 'yes' && $product->get_regular_price() !== 0): ?>
               <span class="shopengine-offer-badge"> -<?php echo esc_html( 100 - round($offPercentage,2) ); ?>%</span>
            <?php endif; ?>

             <!-- sale badge -->
            <?php if($settings['shopengine_is_sale_badge'] === 'yes' ): ?>
               <span class="shopengine-sale-badge"> <?php echo esc_html($settings['shopengine_sale_badge_text']); ?> </span>
            <?php endif; ?>
            
            <!-- countdown clock -->
            <?php if( $settings['shopengine_show_countdown_clock'] === 'yes' ): ?>
            <div class="shopengine-countdown-clock">

               <?php if( $settings['shopengine_show_countdown_clock_days'] === 'yes' ): ?> 
                  <span class="se-clock-item">
                     <span class="clock-days"></span>
                     <span class="clock-days-label"><?php echo esc_html__('Days', 'shopengine') ?></span>
                  </span> 
               <?php endif; ?>  

                <span class="se-clock-item">
                  <span class="clock-hou"></span>
                  <span class="clock-hou-label"><?php echo esc_html__('Hours', 'shopengine') ?></span>
                </span>   

                <span class="se-clock-item">
                  <span class="clock-min"></span>
                  <span class="clock-min-label"><?php echo esc_html__('Min', 'shopengine') ?></span>
                </span>   

                <span class="se-clock-item">
                  <span class="clock-sec"></span>
                  <span class="clock-sec-label"><?php echo esc_html__('Sec', 'shopengine') ?></span>
                </span>  
            </div>

            <?php endif; ?>

         </div>
         
         <!-- product description -->
         <div class="deal-products__desc">
            <h4 class="deal-products__desc--name">  <a href="<?php the_permalink() ?>"> <?php echo esc_html($title) ?> </a>  </h4>
         </div>
         
         <!-- product description -->
         <div class="deal-products__prices">
               <ins><span class="woocommerce-Price-amount amount"><?php echo \Shopengine\Utils\Helper::kses( $price ) ?> </span></ins>
               
               <?php if( !empty( $price )  ) : ?>
                  <del>
                     <span class="woocommerce-Price-amount amount">
                        <?php echo \Shopengine\Utils\Helper::kses( $reg_price ) ?>
                     </span>
                  </del>
               <?php endif; ?>
              
         </div>
         
         <!-- stock and sold line chart -->
         <?php if($settings['shopengine_show_sold_chart'] === 'yes'): ?>
         <div class="deal-products__grap">
            <canvas class="deal-products__grap--line" height="<?php echo esc_attr($progress_data['prog_line_height'] + 2) ?>" data-settings='<?php echo json_encode($progress_data) ?>'></canvas>
            <div class="deal-products__grap__sells">
               <div class="deal-products__grap--available">
                   <span><?php echo esc_html__('Available:', 'shopengine') ?></span>
                   <span class="avl_num"><?php echo esc_html( $available ) ?></span>
               </div>
               <div class="deal-products__grap--sold">
                  <span><?php echo esc_html__( 'Sold:', 'shopengine' ) ?></span>
                   <span class="sld_num"><?php echo esc_html( $total_sell ) ?></span>
               </div>
            </div>
         </div>
         <?php endif;?>

      </div>

      <?php  
      
      endwhile; elseif( $post_type == \ShopEngine\Core\Template_Cpt::TYPE ): 
         echo esc_html__('No deal products available', 'shopengine');
      endif; wp_reset_postdata(); ?>
   </div>
</div>
</div>