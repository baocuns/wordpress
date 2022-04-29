<?php
// Bước 1: Xem thông tin tất cả bài post.
// Kết quả của query sẽ được lưu vào đối tượng $wp_query.
// Kiểm tra đối tượng $wp_query bằng cách chèn đoạn code dưới đây vào file template index.php trong theme:
// echo "<b>Bước 1</b>";
// echo "<pre>";
// print_r($wp_query);
// echo "</pre>";
?>

<!-- Để xem dữ liệu của posts ta trỏ tới thuộc tính posts như ví dụ bên dưới: -->
<?php
// echo "<b>Bước 2</b>";
// echo "<pre>";
// print_r($wp_query->posts);
// echo "</pre>";
?>
<!-- hoặc sử dụng biến $posts như sau: -->
<?php
// echo "<b>Bước 2.2</b>";
// echo "<pre>";
// print_r($posts);
// echo "</pre>";
?>

<!-- Để lấy ra chi tiết một bài post, ta dùng biến $post -->


<!-- 
Bước 3: Lấy ra thông tin tất cả bài post
Để hiển thị toàn bộ bài viết, ta phải dùng vòng lặp while như sau: -->
<?php
// if ($wp_query->have_posts()) {
//     while ($wp_query->have_posts()) {
//         $wp_query->the_post();
//         echo $post->post_title . '<br>';
//     }
// }
?>
<!-- Trong đó:
have_posts() là một phương thức của class WP_Query, dùng kiểm tra xem còn bài viết nào trong query hay không.
the_post() chỉ mục để gọi post kế tiếp trong vòng lặp, nếu không khai báo phương thức này thì vòng lặp sẽ bị lặp không có điểm dừng.
post_title là tiêu đề bài viết -->


<!-- Ngoài ra, ta có thể viết ngắn gọn như sau: -->
<?php
// if (have_posts()): while (have_posts()): the_post();
//        echo $post->post_title . '<br>';
//    endwhile;endif;

?>

<!-- Bước 4: Sử dụng template tags để lấy thông tin bài post
Ở bước 3, để lấy ra tiêu đề bài post, ta dùng $post->post_title
Ngoài ra, ta có thể sử dụng template tags the_title để lấy thông tin bài viết nhanh hơn như sau: -->
<?php
// if (have_posts()): while (have_posts()): the_post();
//        echo the_title('<br>');
//    endwhile;endif;
?>
<!-- Xem thêm các template tags: https://codex.wordpress.org/Template_Tags -->



<?php
// $args = array(
//     'post_type' => 'post', //Loại là post
//     'orderby' => 'rand', //Lấy ngẫu nhiên
//     'posts_per_page' => 5 //Lấy 5 bài post 1 trang
// );

// $the_query = new WP_Query($args);
// if ($the_query->have_posts()) :
//     while ($the_query->have_posts()) :
//         $the_query->the_post();
//         echo the_title("<br>");
//     endwhile;
// endif;
?>

<?php
// echo "<br>Xin chào " . the_author();
?>

<?php
// if ($wp_query->have_posts()) {
//     while ($wp_query->have_posts()) {
//         $wp_query->the_post();
//         //echo $post->post_title . '<br>';
//         var_dump($post);
//         exit;
//     }
// }


// demo plugin group4
?>
<?php
// do_action('baodeptrai');
// exit;

// if ($wp_query->have_posts()) {
//     while ($wp_query->have_posts()) {
//         $wp_query->the_post();
//         //echo $post->post_title . '<br>';
//         var_dump($post);
//     }
// }


// var_dump($products);
?>



<?php
// var_dump(get_terms( 'product_cat'));
$args = array(
    'status' => 'publish'
);
$products = wc_get_products($args);

// var_dump($products);
// $product = get_page_by_title( 'banana', OBJECT, 'product' );
// var_dump(get_permalink( $product->ID ));

get_header();


?>


<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/categories/cat-1.jpg">
                        <h5><a href="#">Fresh Fruit</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/categories/cat-2.jpg">
                        <h5><a href="#">Dried Fruit</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/categories/cat-3.jpg">
                        <h5><a href="#">Vegetables</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/categories/cat-4.jpg">
                        <h5><a href="#">drink fruits</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/categories/cat-5.jpg">
                        <h5><a href="#">drink fruits</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<!-- oranges, fresh-meat, vegetables, fastfood -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".oranges">Oranges</li>
                        <li data-filter=".fresh-meat">Fresh Meat</li>
                        <li data-filter=".vegetables">Vegetables</li>
                        <li data-filter=".fastfood">Fastfood</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row featured__filter">
            <?php
            foreach ($products as $key => $value) {
                $img = $value->get_image_id();
                $product = get_page_by_title( $value->name, OBJECT, 'product' );
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <!-- ?php echo get_template_directory_uri(); ?>/img/featured/feature-2.jpg -->
                    <div class="featured__item">
                        
                            <div class="featured__item__pic set-bg" data-setbg="<?php echo wp_get_attachment_url($img, 'full'); ?>">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="<?php echo get_permalink( $product->ID ); ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="<?php echo get_permalink( $product->ID ); ?>"><?php echo $value->name; ?></a></h6>
                                <h5>$<?php echo $value->price; ?></h5>
                            </div>
                    </div>

                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-1.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-2.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-3.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-1.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-2.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-3.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-1.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-2.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-3.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-1.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-2.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-3.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-1.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-2.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-3.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-1.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-2.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/latest-product/lp-3.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/blog/blog-1.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/blog/blog-2.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/blog/blog-3.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->


<?php get_footer(); ?>