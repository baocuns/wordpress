<?php defined('ABSPATH') || exit; ?>

<div class="shopengine-breadcrumbs">

	<?php
	$iconClass = isset($settings['shopengine_breadcrumbs_icon']['value']) && !empty($settings['shopengine_breadcrumbs_icon']['value']) ? $settings['shopengine_breadcrumbs_icon']['value'] : 'fas fa-arrow-right';

	\ShopEngine\Widgets\Widget_Helper::instance()->wc_breadcrumb_default_filter($iconClass);

	\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter_by_match('woocommerce/global/breadcrumb.php', 'templates/global/breadcrumb.php');

	$args = [
		'delimiter'   => '<i class="' . $iconClass . '" aria-hidden="true"></i>',
		'wrap_before' => '<nav class="woocommerce-breadcrumb">',
		'wrap_after'  => '</nav>',
	];

	woocommerce_breadcrumb($args);
	?>

</div>
