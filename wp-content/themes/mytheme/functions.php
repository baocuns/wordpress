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
    wp_register_style('main-style',get_template_directory_uri() . './css/style.css','all');
    wp_enqueue_style('main-style');

    wp_register_style('index', get_template_directory_uri() . './css/layout.css', 'all');
    wp_enqueue_style('index');

    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/jquery.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script1', get_template_directory_uri() . '/js/jquery.backtotop.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'script2', get_template_directory_uri() . '/js/jquery.mobilemenu.js', array ( 'jquery' ), 1.1, true);
}
add_action('wp_enqueue_scripts', 'my_styles');