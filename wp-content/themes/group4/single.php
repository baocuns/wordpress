<?php
get_header();

$product = wc_get_product(get_the_ID());
// var_dump($product->get_gallery_image_ids());
$attachment_ids = $product->get_gallery_image_ids();
?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="product__details__pic">
					<div class="product__details__pic__item">
						<img class="product__details__pic__item--large" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
					</div>
					<div class="product__details__pic__slider owl-carousel">
						<?php
							foreach( $attachment_ids as $attachment_id ) 
							{?>
									<img data-imgbigurl="<?php echo wp_get_attachment_url( $attachment_id ); ?>" src="<?php echo wp_get_attachment_url( $attachment_id ); ?>" alt="">
							<?php }
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="product__details__text">
					<h3><?php echo $product->name; ?></h3>
					<div class="product__details__rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-half-o"></i>
						<span>(18 reviews)</span>
					</div>
					<div class="product__details__price"><del style="font-size: 1rem;">$<?php echo $product->regular_price; ?></del><br>$<?php echo $product->price; ?></div>
					<p><?php echo $product->short_description; ?></p>
					<div class="product__details__quantity">
						<div class="quantity">
							<div class="pro-qty">
								<input type="text" value="1">
							</div>
						</div>
					</div>
					<a href="?add-to-cart=<?php echo $product->id; ?>" class="primary-btn">ADD TO CARD</a>
					<a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
					<ul>
						<li><b>Availability</b> <span>In Stock</span></li>
						<li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
						<li><b>Weight</b> <span>0.5 kg</span></li>
						<li><b>Share on</b>
							<div class="share">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="product__details__tab">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tabs-1" role="tabpanel">
							<div class="product__details__tab__desc">
								<h6>Products Infomation</h6>
								<p><?php echo $product->description; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Product Details Section End -->

<?php
get_footer();
