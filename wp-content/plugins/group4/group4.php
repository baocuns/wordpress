<?php
/*
   Plugin Name: Group 4
   Plugin URI: https://github.com/baocuns/wordpress
   description: Đây là một plugin được tạo bởi cuns dùng để thế hiện sự đẹp trai của cuns. nó có thể hoạt động nhé !
  a plugin to create awesomeness and spread joy
   Version: 1.0
   Author: Cuns
   Author URI: https://github.com/baocuns/wordpress
   License: GPL2
   */

/**
 * Adds a view to the post being viewed
 *
 * Finds the current views of a post and adds one to it by updating
 * the postmeta. The meta key used is "awepop_views".
 *
 * @global object $post The post object
 * @return integer $new_views The number of views the post has
 *
 */

 //in ra một đoạn chữ cute
function show_baodeptrai()
{
   echo 'bao dep trai';
}
add_action('baodeptrai', 'show_baodeptrai');
