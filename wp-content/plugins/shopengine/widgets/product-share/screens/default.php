<div class="shopengine-product-share">
	<?php

	if(function_exists('__wp_social_api_share')) {

		//$provider = 'pinterest,twitter';  // comma separated value -
		$provider = 'all';
		$attr = [];

		echo __wp_social_api_share(apply_filters('shopengine_share_providers', $provider), apply_filters('shopengine_share_attr', $attr));

	} else {

		woocommerce_template_single_sharing();
	} ?>

</div>
