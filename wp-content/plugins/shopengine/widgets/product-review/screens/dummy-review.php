<div id="reviews" class="woocommerce-Reviews">

   <div id="comments">
      <h2 class="woocommerce-Reviews-title">2 reviews for <span><?php echo esc_html($product->get_name()); ?></span> (dummy reviews, only for preview)</h2>
      <ol class="commentlist">
         <li class="review byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-16">
            <div id="comment-16" class="comment_container">
               <img alt="" src="https://secure.gravatar.com/avatar/7064f941bf63e90bfe35449c62586bc8?s=60&d=mm&r=g" class="avatar avatar-60 photo" height="60" width="60" loading="lazy">
               <div class="comment-text">
                  <div class="star-rating" role="img" aria-label="Rated 5 out of 5"><span style="width:100%">Rated <strong class="rating">5</strong> out of 5</span></div>
                  <p class="meta">
                     <strong class="woocommerce-review__author">Jhon Doe</strong>
                     <em class="woocommerce-review__verified verified">(verified owner)</em> <span class="woocommerce-review__dash">–</span> 
					 <time class="woocommerce-review__published-date" datetime="2021-05-26T13:07:16+00:00">May 26, 2021</time>
                  </p>
                  <div class="description">
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  </div>
               </div>
            </div>
         </li>
         <!-- #comment-## -->
         <li class="review byuser comment-author-admin bypostauthor odd alt thread-odd thread-alt depth-1" id="li-comment-17">
            <div id="comment-17" class="comment_container">
               <img alt="Review Avatar" src="https://secure.gravatar.com/avatar/7064f941bf63e90bfe35449c62586bc8?s=60&d=mm&r=g" class="avatar avatar-60 photo" height="60" width="60" loading="lazy">
               <div class="comment-text">
                  <div class="star-rating" role="img" aria-label="Rated 3 out of 5"><span style="width:60%">Rated <strong class="rating">3</strong> out of 5</span></div>
                  <p class="meta">
                     <strong class="woocommerce-review__author">David </strong>
                     <em class="woocommerce-review__verified verified">(verified owner)</em> <span class="woocommerce-review__dash">–</span>
					 <time class="woocommerce-review__published-date" datetime="2021-05-26T13:07:31+00:00">May 26, 2021</time>
                  </p>
                  <div class="description">
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  </div>
               </div>
            </div>
         </li>
      </ol>
   </div>

	<div id="review_form_wrapper">
		<div id="review_form">
			<div id="respond" class="comment-respond">
				<span id="reply-title" class="comment-reply-title">
				Add a review 
				<small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a></small>
				</span>
				<form action="#" method="post" id="commentform" class="comment-form" novalidate="">
					<div class="comment-form-rating">
					<label for="rating">Your rating&nbsp;<span class="required">*</span></label>
					<p class="stars">
						<span>
						<a class="star-1" href="#">1</a>
						<a class="star-2" href="#">2</a>
						<a class="star-3" href="#">3</a>
						<a class="star-4" href="#">4</a>
						<a class="star-5" href="#">5</a>
						</span>
					</p>
					<select name="rating" id="rating" required="" style="display: none;">
						<option value="">Rate…</option>
						<option value="5">Perfect</option>
						<option value="4">Good</option>
						<option value="3">Average</option>
						<option value="2">Not that bad</option>
						<option value="1">Very poor</option>
					</select>
					</div>
					<p class="comment-form-comment">
					<label for="comment">Your review&nbsp;<span class="required">*</span></label>
					<textarea id="comment" name="comment" cols="45" rows="8" required=""></textarea>
					</p>
					<p class="form-submit">
					<input name="submit" type="submit" id="submit" class="submit" value="Submit">
					<input type="hidden" name="comment_post_ID" value="307" id="comment_post_ID">
					<input type="hidden" name="comment_parent" id="comment_parent" value="0">
					</p>
				</form>
			</div>
			<!-- #respond -->
		</div>
	</div>

   <div class="clear"></div>
</div>