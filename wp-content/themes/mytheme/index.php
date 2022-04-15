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

<?php get_header() ; ?>

<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="nospace">
        <li><i class="fas fa-mobile-alt rgtspace-5"></i> +00 (123) 456 7890</li>
        <li><i class="far fa-envelope rgtspace-5"></i> info@domain.com</li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace">
        <li><a href="#"><i class="fas fa-home"></i></a></li>
        <li><a href="#" title="Help Centre"><i class="far fa-life-ring"></i></a></li>
        <li><a href="#" title="Login"><i class="fas fa-sign-in-alt"></i></a></li>
        <li><a href="#" title="Sign Up"><i class="fas fa-edit"></i></a></li>
        <li id="searchform">
          <div>
            <form action="#" method="post">
              <fieldset>
                <legend>Quick Search:</legend>
                <input type="text" placeholder="Enter search term&hellip;">
                <button type="submit"><i class="fas fa-search"></i></button>
              </fieldset>
            </form>
          </div>
        </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
      <li class="one_quarter first">
        <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Give us a call:</strong> +00 (123) 456 7890</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> support@domain.com</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Mon. - Sat.:</strong> 08.00am - 18.00pm</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-map-marker-alt"></i></a> <span><strong>Come visit us:</strong> Directions to <a href="#">our location</a></span></div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay padtop" style="background-image:url('images/demo/backgrounds/01.png');"> 
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
      <!-- ################################################################################################ -->
      <h1><a href="index.html">Spourmo</a></h1>
      <!-- ################################################################################################ -->
    </div>
    <nav id="mainav" class="fl_right"> 
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li class="active"><a href="index.html">Home</a></li>
        <li><a class="drop" href="#">Pages</a>
          <ul>
            <li><a href="pages/gallery.html">Gallery</a></li>
            <li><a href="pages/full-width.html">Full Width</a></li>
            <li><a href="pages/sidebar-left.html">Sidebar Left</a></li>
            <li><a href="pages/sidebar-right.html">Sidebar Right</a></li>
            <li><a href="pages/basic-grid.html">Basic Grid</a></li>
            <li><a href="pages/font-icons.html">Font Icons</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Dropdown</a>
          <ul>
            <li><a href="#">Level 2</a></li>
            <li><a class="drop" href="#">Level 2 + Drop</a>
              <ul>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
              </ul>
            </li>
            <li><a href="#">Level 2</a></li>
          </ul>
        </li>
        <li><a href="#">Link Text</a></li>
        <li><a href="#">Link Text</a></li>
        <li><a href="#">Link Text</a></li>
      </ul>
      <!-- ################################################################################################ -->
    </nav>
  </header>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <h3 class="heading">Senectus et netus</h3>
      <p>Et malesuada fames ac turpis egestas duis rutrum eros ut sapien in hac habitasse platea dictumst aliquam venenatis leo et orci ut pretium odio eu nisi nulla at.</p>
      <footer>
        <ul class="nospace inline pushright">
          <li><a class="btn" href="#">Egestas</a></li>
          <li><a class="btn inverse" href="#">Tristique</a></li>
        </ul>
      </footer>
    </article>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <ul class="nospace group grid-3">
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption><a href="#">Aliquam faucibus</a></figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption><a href="#">Aliquam faucibus</a></figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption><a href="#">Aliquam faucibus</a></figcaption>
          </figure>
        </li>
      </ul>
    </section>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
  <section class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <figure class="one_half first">
      <h6 class="heading">Ante fringilla nisl eu</h6>
      <p class="btmspace-30">Gravida lorem ligula quis ligula pellentesque congue semper felis maecenas rutrum euismod nibh class aptent taciti.</p>
      <ul class="nospace clear points">
        <li><a href="#"><i class="fas fa-equals"></i></a>
          <h6 class="heading">Sociosqu ad litora torquent</h6>
          <p>Per conubia nostra per inceptos himenaeos mauris lectus enim luctus vitae viverra a pharetra mollis diam aliquam.</p>
        </li>
        <li><a href="#"><i class="fas fa-exclamation-circle"></i></a>
          <h6 class="heading">Sociosqu ad litora torquent</h6>
          <p>Per conubia nostra per inceptos himenaeos mauris lectus enim luctus vitae viverra a pharetra mollis diam aliquam.</p>
        </li>
      </ul>
    </figure>
    <div class="one_half last"><a class="imgover" href="#"><img src="images/demo/480x300.png" alt=""></a></div>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section id="services" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <p class="nospace font-xs">Mollis eu commodo eu dui quisque</p>
      <h6 class="heading">Ut ipsum vivamus tincidunt</h6>
    </div>
    <ul class="nospace group grid-3">
      <li class="one_third">
        <article><a href="#"><i class="fas fa-chess-king"></i></a>
          <h6 class="heading">Tincidunt enim etiam</h6>
          <p>Tellus lacus tempor in pharetra id imperdiet sit amet enim suspendisse potenti fusce ornare imperdiet sit amet enim suspendisse.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="fas fa-archive"></i></a>
          <h6 class="heading">Tincidunt enim etiam</h6>
          <p>Tellus lacus tempor in pharetra id imperdiet sit amet enim suspendisse potenti fusce ornare imperdiet sit amet enim suspendisse.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="fas fa-backspace"></i></a>
          <h6 class="heading">Tincidunt enim etiam</h6>
          <p>Tellus lacus tempor in pharetra id imperdiet sit amet enim suspendisse potenti fusce ornare imperdiet sit amet enim suspendisse.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="fas fa-bezier-curve"></i></a>
          <h6 class="heading">Tincidunt enim etiam</h6>
          <p>Tellus lacus tempor in pharetra id imperdiet sit amet enim suspendisse potenti fusce ornare imperdiet sit amet enim suspendisse.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="fas fa-box-open"></i></a>
          <h6 class="heading">Tincidunt enim etiam</h6>
          <p>Tellus lacus tempor in pharetra id imperdiet sit amet enim suspendisse potenti fusce ornare imperdiet sit amet enim suspendisse.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="fas fa-luggage-cart"></i></a>
          <h6 class="heading">Tincidunt enim etiam</h6>
          <p>Tellus lacus tempor in pharetra id imperdiet sit amet enim suspendisse potenti fusce ornare imperdiet sit amet enim suspendisse.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <section class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <p class="nospace font-xs">Mollis eu commodo eu dui quisque</p>
      <h6 class="heading">Ut ipsum vivamus tincidunt</h6>
    </div>
    <figure>
      <figcaption class="center btmspace-50"><a href="#">Pharetra</a> / <a href="#">Imperdiet</a> / <a href="#">Suspendisse</a> / <a href="#">Potenti</a></figcaption>
      <ul class="nospace group grid-3">
        <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
        <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
        <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
        <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
        <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
        <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
      </ul>
    </figure>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <article>
      <figure><img src="images/demo/100x100.png" alt=""></figure>
      <h6 class="heading font-x2">J. Doe</h6>
      <em>Conubia nostra per inceptos</em>
      <blockquote>Himenaeos curabitur feugiat etiam in enim sed felis interdum lobortis phasellus nec eros ut arcu sollicitudin pellentesque curabitur porta justo vitae molestie semper ligula enim sed felis interdum lobortis phasellus nec eros ut arcu sollicitudin pellentesque curabitur porta justo vitae molestie semper ligula.</blockquote>
    </article>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <section class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <p class="nospace font-xs">Mollis eu commodo eu dui quisque</p>
      <h6 class="heading">Ut ipsum vivamus tincidunt</h6>
    </div>
    <ul id="latest" class="nospace group sd-third">
      <li class="one_third first">
        <article>
          <figure><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Nisl nullam odio justo pharetra</h6>
              <ul class="nospace meta clear">
                <li><i class="fas fa-user"></i> <a href="#">Admin</a></li>
                <li>
                  <time datetime="2045-04-06T08:15+00:00">06 Apr 2045</time>
                </li>
              </ul>
            </figcaption>
          </figure>
          <p>Et sagittis ac dignissim nec metus proin nunc maecenas vel nulla vivamus mattis massa vitae metus proin nunc maecenas vel nulla vivamus mattis massa vitae.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article>
          <figure><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Nisl nullam odio justo pharetra</h6>
              <ul class="nospace meta clear">
                <li><i class="fas fa-user"></i> <a href="#">Admin</a></li>
                <li>
                  <time datetime="2045-04-05T08:15+00:00">05 Apr 2045</time>
                </li>
              </ul>
            </figcaption>
          </figure>
          <p>Et sagittis ac dignissim nec metus proin nunc maecenas vel nulla vivamus mattis massa vitae metus proin nunc maecenas vel nulla vivamus mattis massa vitae.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article>
          <figure><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Nisl nullam odio justo pharetra</h6>
              <ul class="nospace meta clear">
                <li><i class="fas fa-user"></i> <a href="#">Admin</a></li>
                <li>
                  <time datetime="2045-04-04T08:15+00:00">04 Apr 2045</time>
                </li>
              </ul>
            </figcaption>
          </figure>
          <p>Et sagittis ac dignissim nec metus proin nunc maecenas vel nulla vivamus mattis massa vitae metus proin nunc maecenas vel nulla vivamus mattis massa vitae.</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Bottom Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row4">
    <footer id="footer" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div class="group btmspace-50">
        <div class="one_quarter first">
          <h6 class="heading">Lorem proin volutpat</h6>
          <p>Ligula quis sapien nam molestie massa quis pede maecenas quis lacus nunc sed lectus quis lectus tristique tincidunt sed varius nisl tincidunt lectus pellentesque sagittis mauris ut leo ullamcorper tortor morbi accumsan [<a href="#">&hellip;</a>]</p>
          <ul class="faico clear">
            <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
            <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
          </ul>
        </div>
        <div class="one_quarter">
          <h6 class="heading">Nascetur ridiculus mus</h6>
          <ul class="nospace linklist">
            <li><a href="#">Aliquam eget leo praesent</a></li>
            <li><a href="#">Vel urna nunc ultricies</a></li>
            <li><a href="#">Faucibus nunc cum sociis</a></li>
            <li><a href="#">Natoque penatibus et magnis</a></li>
            <li><a href="#">Dis parturient montes</a></li>
          </ul>
        </div>
        <div class="one_quarter">
          <h6 class="heading">Vestibulum sed quam</h6>
          <p class="nospace btmspace-15">Ante dapibus luctus sed quis diam vitae ipsum ultrices vehicula.</p>
          <form action="#" method="post">
            <fieldset>
              <legend>Newsletter:</legend>
              <input class="btmspace-15" type="text" value="" placeholder="Name">
              <input class="btmspace-15" type="text" value="" placeholder="Email">
              <button class="btn" type="submit" value="submit">Submit</button>
            </fieldset>
          </form>
        </div>
        <div class="one_quarter">
          <h6 class="heading">Aenean diam euismod</h6>
          <ul class="nospace clear latestimg">
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
            <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          </ul>
        </div>
      </div>
      <!-- ################################################################################################ -->
      <hr class="btmspace-50">
      <!-- ################################################################################################ -->
      <nav>
        <ul class="nospace">
          <li><a href="index.html"><i class="fas fa-lg fa-home"></i></a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Terms</a></li>
          <li><a href="#">Privacy</a></li>
          <li><a href="#">Cookies</a></li>
          <li><a href="#">Disclaimer</a></li>
        </ul>
      </nav>
      <!-- ################################################################################################ -->
<?php get_footer(); ?>