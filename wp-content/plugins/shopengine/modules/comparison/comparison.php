<?php

namespace ShopEngine\Modules\Comparison;

use ShopEngine\Core\Register\Module_List;
use ShopEngine\Traits\Singleton;
use ShopEngine\Utils\Helper;

class Comparison {
	const COOKIE_KEY = 'shopengine_comparison_id_list';
	const ONCLICK_SELECTOR_CLS = 'shopengine_comparison_add_to_list_action';
	const COOKIE_TIME_IN_DAYS = 1;

	use Singleton;

	public function init() {

		if(!empty($_REQUEST['shopengine_quickview'])) {

			// In quickview modal we will not show anything
			return;
		}

		new Route();

		$sett              = Module_List::instance()->get_settings('comparison');
		$is_show_in_single = isset($sett['show_on_single_page']['value']) ? ($sett['show_on_single_page']['value'] === 'yes') : true;

		if($is_show_in_single === true) {

			if($this->get_where_to($sett) == 'after') {

				add_action('woocommerce_after_add_to_cart_button', [$this, 'print_the_button_in_single_page']);

			} else {

				add_action('woocommerce_before_add_to_cart_button', [$this, 'print_the_button_in_single_page']);
			}
		}

		$is_show = isset($sett['show_on_archive_page']['value']) ? ($sett['show_on_archive_page']['value'] === 'yes') : true;

		$show_in_archive = apply_filters('shopengine/module/wishlist/show_icon_in_shop_page', $is_show);

		if($show_in_archive === true) {

			add_filter('woocommerce_loop_add_to_cart_link', [$this, 'print_button_in_shop'], 10, 3);
		}


		add_action('wp_enqueue_scripts', [$this, 'enqueue']);

		// Modal Wrapper
		add_action( 'wp_footer', [$this, 'qc_modal_wrapper'] );


		add_action( 'woocommerce_admin_process_product_object', [new Group_Meta(), 'index'], 10, 1 );

	}


	public function qc_modal_wrapper() {
		?>
		<div class="shopengine-comparison-modal se-modal-wrapper">
			<div class="se-modal-inner"></div>
		</div>
		<?php
	}

	public function enqueue() {
		// Comparison Styles
		wp_enqueue_style('shopengine-comparison', \ShopEngine::module_url() . 'comparison/assets/css/comparison.css', ['shopengine-modal-styles']);

		// Comparison Scripts
		wp_enqueue_script(
			'shopengine-comparison',
			\ShopEngine::module_url() . 'comparison/assets/js/comparison.js',
			['jquery', 'shopengine-modal-script'],
			\ShopEngine::version(),
			true
		);


		wp_localize_script('shopengine-comparison', 'shopEngineComparison', [
			'product_id' => get_the_ID(),
			'resturl'    => get_rest_url(),
			'rest_nonce' => wp_create_nonce('wp_rest'),
		]);
	}


	public function get_where_to($settings = []) {

		$position = !empty($settings['show_icon_where_to']['value']) ? $settings['show_icon_where_to']['value'] : 'after';

		return apply_filters('shopengine/module/comparison/put_icon_in_side', $position);
	}


	private function is_exists_in_list($idd) {

		if(empty($_COOKIE[Comparison::COOKIE_KEY])) {
			return false;
		}

		$content = explode(',', $_COOKIE[Comparison::COOKIE_KEY]);


		return in_array($idd, $content);
	}


	public function add_to_menu($menu_links) {

		$logout = $menu_links['customer-logout'];

		unset($menu_links['customer-logout']);

		$menu_links['wishlist']        = 'Wishlist';
		$menu_links['customer-logout'] = $logout;

		return $menu_links;
	}


	public function print_the_button_in_single_page() {

		$left_text  = apply_filters('shopengine/module/wishlist/optional_text_left', '');
		$right_text = apply_filters('shopengine/module/wishlist/optional_text_right', '');

		$pid          = get_the_ID();
		$exist        = $this->is_exists_in_list($pid);
		$cls          = $exist ? 'active' : 'inactive';
		$compare_icon = '<i class="shopengine-icon-product_compare_1"></i>';

		echo Helper::kses($left_text); ?>

    <a
            data-payload='{"pid":<?php echo intval($pid) ?>}'
            class="<?php echo self::ONCLICK_SELECTOR_CLS ?> shopengine-comparison badge <?php echo esc_attr($cls) ?>"
    > <?php echo Helper::kses($compare_icon) ?> </a><?php

		echo Helper::kses($right_text);
	}


	function print_button_in_shop($add_to_cart_html, $product, $args = []) {

		$sett = Module_List::instance()->get_settings('comparison');

		$left_text  = apply_filters('shopengine/module/wishlist/optional_text_left', '');
		$right_text = apply_filters('shopengine/module/wishlist/optional_text_right', '');

		$pid          = $product->get_id();
		$exist        = $this->is_exists_in_list($pid);
		$cls          = $exist ? 'active' : 'inactive';
		$compare_icon = '<i class="shopengine-icon-product_compare_1"></i>';

		$btn = $left_text .
			'<a data-payload=\'{"pid":' . $product->get_id() . '}\'' .
			' class="' . self::ONCLICK_SELECTOR_CLS . ' shopengine-comparison badge se-btn ' . esc_attr($cls) . '"> ' . $compare_icon . ' </a>' .
			$right_text;


		if($this->get_where_to() == 'after') {
			$before = '';
			$after  = $btn;
		} else {

			$before = $btn;
			$after  = '';
		}

		return $before . $add_to_cart_html . $after;
	}
}
