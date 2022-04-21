<?php

/**
@ Thiết lập hàm hiển thị logo
@ mytheme_logo()
 **/
if (!function_exists('mytheme_logo')) {
    function mytheme_logo()
    { ?>
        <div class="logo">
            <div class="site-name">
            <?php
            printf(
                '<h1><a href="%s" title="%s">%s</a></h1>',
                get_bloginfo('url'),
                get_bloginfo('description'),
                get_bloginfo('sitename')
            );
            ?>
            </div>
            <div class="site-description"><?php bloginfo('description'); ?></div>
        </div>
    <?php }
}

/**
@ Thiết lập hàm hiển thị menu
@ mytheme_menu( $slug )
 **/
if (!function_exists('mytheme_menu')) {
    function mytheme_menu($slug)
    {
        $menu = array(
            'theme_location' => $slug,
            'container' => 'nav',
            'container_class' => $slug,
        );
        wp_nav_menu($menu);
    }
}

/**
@ Chèn CSS và Javascript vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
 **/
function my_styles()
{
    /*
    * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
    * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
    */
    // css
    wp_register_style('main-style',get_template_directory_uri() . './css/style.css','all');
    wp_enqueue_style('main-style');
    wp_register_style('boorstrap',get_template_directory_uri() . './css/bootstrap.min.css','all');
    wp_enqueue_style('boorstrap');
    wp_register_style('font',get_template_directory_uri() . './css/font-awesome.min.css','all');
    wp_enqueue_style('font');
    wp_register_style('elegant',get_template_directory_uri() . './css/elegant-icons.css','all');
    wp_enqueue_style('elegant');
    wp_register_style('nice',get_template_directory_uri() . './css/nice-select.css','all');
    wp_enqueue_style('nice');
    wp_register_style('jquery',get_template_directory_uri() . './css/jquery-ui.min.css','all');
    wp_enqueue_style('jquery');
    wp_register_style('owl',get_template_directory_uri() . './css/owl.carousel.min.css','all');
    wp_enqueue_style('owl');
    wp_register_style('slicknav',get_template_directory_uri() . './css/slicknav.min.css','all');
    wp_enqueue_style('slicknav');
    wp_register_style('all',get_template_directory_uri() . './css/all.css','all');
    wp_enqueue_style('all');

    // js

    wp_enqueue_script( 'script', get_template_directory_uri() . './js/jquery-3.3.1.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script1', get_template_directory_uri() . './js/bootstrap.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script2', get_template_directory_uri() . './js/jquery.nice-select.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script3', get_template_directory_uri() . './js/jquery-ui.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script4', get_template_directory_uri() . './js/jquery.slicknav.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script5', get_template_directory_uri() . './js/mixitup.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script6', get_template_directory_uri() . './js/owl.carousel.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script7', get_template_directory_uri() . './js/main.js', array ( 'jquery' ), 1.1, true);
}
add_action('wp_enqueue_scripts', 'my_styles');