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
$args = array(
    'post_type' => 'post', //Loại là post
    'orderby' => 'rand', //Lấy ngẫu nhiên
    'posts_per_page' => 5 //Lấy 5 bài post 1 trang
);

$the_query = new WP_Query($args);
if ($the_query->have_posts()) :
    while ($the_query->have_posts()) :
        $the_query->the_post();
        echo the_title("<br>");
    endwhile;
endif;
?>

<?php
// echo "<br>Xin chào " . the_author();
?>

<?php get_header() ; ?>
<?php get_footer(); ?>