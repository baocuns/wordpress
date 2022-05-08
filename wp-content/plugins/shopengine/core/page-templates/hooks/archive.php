<?php

namespace ShopEngine\Core\Page_Templates\Hooks;

use ShopEngine\Compatibility\Conflicts\Theme_Hooks;
use ShopEngine\Core\Builders\Templates;

defined('ABSPATH') || exit;

class Archive extends Base {

	protected $page_type = 'archive';
	protected $template_part = 'content-archive.php';

	public function init() : void {

		add_action('wp_enqueue_scripts', [$this, 'enqueue_css_with_conflicts_removed'], 9999);
		add_filter('woocommerce_enqueue_styles', [Theme_Hooks::instance(), 'force_load_woocommerce_css'], 9998);

		// add_action('woocommerce_before_shop_loop_item', [$this, 'delayed_hook_conflicts'], 9999);
		$this->delayed_hook_conflicts();
	}

	public function delayed_hook_conflicts() {

		// add_action('template_include', function ($template) {

			// if($this->tpl_loaded) {

				Theme_Hooks::instance()->theme_conflicts_archive_page_after_wp_loaded();
				Theme_Hooks::instance()->theme_conflicts_in_specific_footer_area();
			// }

			// return $template;

		// }, 9991);
	}

	public function enqueue_css_with_conflicts_removed() {

			wp_dequeue_style('oceanwp-woocommerce');


			if(!wp_style_is('woocommerce-general', 'registered')) {

				$styles = \WC_Frontend_Scripts::get_styles();

				if($styles) {
					foreach($styles as $handle => $args) {

						wp_register_style($handle, $args['src'], $args['deps'], $args['version'], $args['media']);
					}
				}
			}

			wp_enqueue_style('woocommerce-general');
			wp_enqueue_style('woocommerce-layout');
	}


	protected function template_include_pre_condition(): bool {

		return is_product_category() || is_product_tag() || is_tax(get_object_taxonomies('product')) || (is_search() && !empty($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'product');
	}
}
