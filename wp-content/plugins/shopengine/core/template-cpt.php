<?php

namespace ShopEngine\Core;

use ShopEngine\Core\Builders\Action;
use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;


class Template_Cpt {

	const TYPE = 'shopengine-template';

	use Singleton;


	public function init() {
		add_action('init', [$this, 'register_custom_post_types']);
		add_action('admin_menu', [$this, 'cpt_menu'], 99);

		add_filter('post_row_actions', [$this, 'filter_post_row_actions'], 20, 2);
	}

	public function cpt_menu() {
		$link_our_new_cpt = 'edit.php?post_type=' . self::TYPE . '#shopengine-templates';
		add_submenu_page(
			'shopengine-settings',
			esc_html__('Builder Templates', 'shopengine'),
			esc_html__('Builder Templates', 'shopengine'),
			'manage_options',
			$link_our_new_cpt
		);
	}

	public function register_custom_post_types() {

		$labels = [
			'name'                  => esc_html_x('Builder Templates', 'Post Type General Name', 'shopengine'),
			'singular_name'         => esc_html_x('Builder Template', 'Post Type Singular Name', 'shopengine'),
			'menu_name'             => esc_html__('Builder Template', 'shopengine'),
			'name_admin_bar'        => esc_html__('Builder Template', 'shopengine'),
			'archives'              => esc_html__('Template Archives', 'shopengine'),
			'attributes'            => esc_html__('Template Attributes', 'shopengine'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'shopengine'),
			'all_items'             => esc_html__('Templates', 'shopengine'),
			'add_new_item'          => esc_html__('Add New Template', 'shopengine'),
			'add_new'               => esc_html__('Add New', 'shopengine'),
			'new_item'              => esc_html__('New Template', 'shopengine'),
			'edit_item'             => esc_html__('Edit Template', 'shopengine'),
			'update_item'           => esc_html__('Update Template', 'shopengine'),
			'view_item'             => esc_html__('View Template', 'shopengine'),
			'view_items'            => esc_html__('View Templates', 'shopengine'),
			'search_items'          => esc_html__('Search Templates', 'shopengine'),
			'not_found'             => esc_html__('Not found', 'shopengine'),
			'not_found_in_trash'    => esc_html__('Not found in Trash', 'shopengine'),
			'featured_image'        => esc_html__('Featured Image', 'shopengine'),
			'set_featured_image'    => esc_html__('Set featured image', 'shopengine'),
			'remove_featured_image' => esc_html__('Remove featured image', 'shopengine'),
			'use_featured_image'    => esc_html__('Use as featured image', 'shopengine'),
			'insert_into_item'      => esc_html__('Insert into Template', 'shopengine'),
			'uploaded_to_this_item' => esc_html__('Uploaded to this Template', 'shopengine'),
			'items_list'            => esc_html__('Templates list', 'shopengine'),
			'items_list_navigation' => esc_html__('Templates list navigation', 'shopengine'),
			'filter_items_list'     => esc_html__('Filter from list', 'shopengine'),
		];

		$rewrite = [
			'slug'       => 'shopengine-template',
			'with_front' => true,
			'pages'      => false,
			'feeds'      => false,
		];

		$args = [
			'label'               => esc_html__('Builder Templates', 'shopengine'),
			'description'         => esc_html__('ShopEngine Builder Template', 'shopengine'),
			'labels'              => $labels,
			'supports'            => ['title', 'editor', 'elementor', 'permalink'],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'rewrite'             => $rewrite,
			'query_var'           => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
			'rest_base'           => self::TYPE,
		];

		register_post_type(self::TYPE, $args);
	}


	public function filter_post_row_actions($actions, $post) {

		if(Action::is_edit_with_gutenberg($post->ID)) {

			$actions['shopengine_edit_with_gutenberg'] = sprintf(
				'<a href="%1$s">%2$s</a>',
				$this->get_edit_url($post->ID),
				esc_html__('Edit with Gutenberg', 'shopengine')
			);
		}

		return $actions;
	}

	public function get_edit_url($pid) {

		$url = add_query_arg(
			[
				'post'   => $pid,
				'action' => 'edit',
			],
			admin_url('post.php')
		);


		$url = apply_filters('shopengine/cpt/template/urls/edit', $url, $pid, $this);

		return $url;
	}
}
