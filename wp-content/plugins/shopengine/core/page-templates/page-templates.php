<?php

namespace ShopEngine\Core\PageTemplates;

defined('ABSPATH') || exit;

use ShopEngine\Traits\Singleton;
use ShopEngine\Widgets\Products;


class Page_Templates {
	use Singleton;

	private $templateList = [];
	private $listedCollected = false;

	public function init() {

		$templates = $this->getTemplates();

		foreach($templates as $key => $template) {

			if(isset($template['class']) && $template['class']) {

				new $template['class']();

			}
		}
	}


	public function getTemplates() {

		if(!$this->listedCollected) {
			$this->templateList    = apply_filters('shopengine/page_templates', $this->get_list());
			$this->listedCollected = true;
		}

		return $this->templateList;
	}

	public function getTemplate($slug) {
		$page_templates = $this->getTemplates();

		return $page_templates[$slug] ?? [];
	}


	public function get_list() {
		$shop_url = get_permalink(wc_get_page_id('shop'));
		$shop_url = (strpos($shop_url, '?page_id') !== false ? get_home_url() . '?post_type=product' : $shop_url);

		return [
			'shop'     => [
				'title'   => esc_html__('Shop', 'shopengine'),
				'package' => 'free',
				'class'   => 'ShopEngine\Core\Page_Templates\Hooks\Shop',
				'opt_key' => 'shop',
				'css'     => 'shop',
				'url'     => $shop_url,
			],
			'archive'  => [
				'title'   => esc_html__('Archive', 'shopengine'),
				'package' => 'free',
				'class'   => 'ShopEngine\Core\Page_Templates\Hooks\Archive',
				'opt_key' => 'archive',
				'css'     => 'archive',
				'url'     => $shop_url,
			],
			'single'   => [
				'title'   => esc_html__('Single', 'shopengine'),
				'package' => 'free',
				'class'   => 'ShopEngine\Core\Page_Templates\Hooks\Single',
				'opt_key' => 'single',
				'css'     => 'single',
				'url'     => get_permalink(Products::instance()->get_a_simple_product_id()),
			],
			'cart'     => [
				'title'   => esc_html__('Cart', 'shopengine'),
				'package' => 'free',
				'class'   => 'ShopEngine\Core\Page_Templates\Hooks\Cart',
				'opt_key' => 'cart',
				'css'     => 'cart',
				'url'     => get_permalink(wc_get_page_id('cart')),
			],
			'checkout' => [
				'title'   => esc_html__('Checkout', 'shopengine'),
				'package' => 'free',
				'class'   => 'ShopEngine\Core\Page_Templates\Hooks\Checkout',
				'opt_key' => 'checkout',
				'css'     => 'checkout',
				'url'     => get_permalink(wc_get_page_id('checkout')),
			],
		];
	}
}
