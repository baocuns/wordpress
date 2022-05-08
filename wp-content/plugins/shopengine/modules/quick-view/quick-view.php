<?php

namespace ShopEngine\Modules\Quick_View;

use ShopEngine\Traits\Singleton;
use ShopEngine\Utils\Helper;

/**
 * Class Wish_List
 *
 * Main Module Class
 *
 * @since 1.0.0
 */
class Quick_View
{

	use Singleton;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		add_filter('shopengine/page_templates', [$this, 'add_quick_view'], 1);

		if(!empty($_REQUEST['shopengine_quickview'])) {

			// In quickview modal we will not show anything
			return;
		}

		add_action('wp_enqueue_scripts', function () {

			wp_enqueue_script('flexslider');

			// Modal Stylesheet
			wp_enqueue_style( 'shopengine-modal-styles' );

			// Modal Script
			wp_enqueue_script(
				'shopengine-quickview',
				plugin_dir_url(__FILE__) . 'assets/js/script.js',
				['jquery', 'shopengine-modal-script']
			);

		});

		add_filter('woocommerce_loop_add_to_cart_link', [$this, 'print_button'], 10, 3);

		// Modal Wrapper
		add_action( 'wp_footer', [$this, 'qc_modal_wrapper'] );
	}

	public function add_quick_view($list) {

		return array_merge($list, [
			'quick_view'           => [
				'title'   => esc_html__('Quick View', 'shopengine'),
				'class'   => '\ShopEngine\Modules\Quick_View\Quick_View',
				'opt_key' => 'quick_view',
				'css'     => 'quick-view',
			],
		]);
    }

	public function qc_modal_wrapper() {
		?>
		<div class="shopengine-quick-view-modal se-modal-wrapper"></div>
		<?php
	}

	function print_button($add_to_cart_html, $product, $args = []) {
		$eye_icon = '<i class="shopengine-icon-quick_view_1"></i>';

		$after = ''; // Add some text or HTML here as well.
		$before = "<a class='shopengine-quickview-trigger se-btn'
					data-source-url='" . get_permalink($product->get_id()) . "'
					href='" . get_permalink($product->get_id()) . "'>
					" . $eye_icon . "
				</a>";

		$before = apply_filters('shopengine_quick_view_button_content', $before);
		
		return $before . $add_to_cart_html . $after;
	}
}
