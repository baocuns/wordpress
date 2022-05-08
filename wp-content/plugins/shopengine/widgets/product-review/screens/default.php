<?php defined('ABSPATH') || exit;

\ShopEngine\Widgets\Widget_Helper::instance()->comment_template_filter_checker();

?>

<div class="shopengine-product-review">
	<?php

	$open = comments_open();

	$in_editor_mode = \ShopEngine\Core\Template_Cpt::TYPE == get_post_type();

	if($in_editor_mode) {

		$open = true;

		global $post;

		$main_post = clone $post;

		$post = get_post($product->get_id());

		include __DIR__ . '/dummy-review.php';
	}

	if($open && !$in_editor_mode) {
		comments_template();
	}

	if($in_editor_mode) {

		global $post;

		$post = $main_post;
	}

	?>
</div>
