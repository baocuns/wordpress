<?php

namespace ShopEngine\Core\Builders;

use ShopEngine\Core\PageTemplates\Page_Templates;
use ShopEngine\Core\Template_Cpt;
use ShopEngine\Traits\Singleton;
use ShopEngine\Utils\Helper;

defined('ABSPATH') || exit;

class Hooks {

	use Singleton;

	public $action;
	public $actionPost_type = ['product']; // only for woocommerce product


	public function init() {

		$this->action = new Action();
		$cptName      = Template_Cpt::TYPE;

		// check admin init
		add_action('admin_init', [$this, 'add_author_support'], 10);
		add_filter('manage_' . $cptName . '_posts_columns', [$this, 'set_columns']);
		add_action('manage_' . $cptName . '_posts_custom_column', [$this, 'render_column'], 10, 2);

		// add filter for search
		add_action('restrict_manage_posts', [$this, 'add_filter']);
		// query filter
		add_filter('parse_query', [$this, 'query_filter']);
	}


	/**
	 * Public function add_author_support.
	 * check author support
	 *
	 * @since 1.0.0
	 */
	public function add_author_support() {

		add_post_type_support(Template_Cpt::TYPE, 'author');
	}


	/**
	 * Public function set_columns.
	 * set column for custom post type
	 *
	 * @since 1.0.0
	 */
	public function set_columns($columns) {

		$date_column   = $columns['date'];
		$author_column = $columns['author'];

		unset($columns['date']);
		unset($columns['author']);

		$columns['type']        = esc_html__('Type', 'shopengine');
		$columns['set_default'] = esc_html__('Default', 'shopengine');
		$columns['builder']     = esc_html__('Builder', 'shopengine');
		$columns['author']      = esc_html($author_column);
		$columns['date']        = esc_html($date_column);

		return $columns;
	}


	/**
	 * Public function render_column.
	 * Render column for custom post type
	 *
	 * @param $column
	 * @param $post_id
	 * @since 1.0.0
	 *
	 */
	public function render_column($column, $post_id) {

		$data                 = get_post_meta($post_id, Action::PK__SHOPENGINE_TEMPLATE, true);
		$template_type        = isset($data['form_type']) ? $data['form_type'] : '';
		$template_config_data = \ShopEngine\Core\PageTemplates\Page_Templates::instance()->getTemplate($template_type);
		$template_class       = $template_config_data['class'] ?? null;
		$category             = isset($data['category_id']) ? $data['category_id'] : '';

		if('' !== $category) {
			$template_id = get_option(Action::PK__SHOPENGINE_TEMPLATE . '__' . $template_type.'__'.$category, 0);
		} else {
			$template_id = Templates::get_registered_template_id($template_type);
		}

		switch($column) {
			case 'type':
				
				$template = Page_Templates::instance()->getTemplate($template_type);
				echo empty($template) ?  '' : $template['title'];
				if(isset($data['category_id']) && class_exists(\ShopEngine_Pro::class)) {
					$cat_name = get_the_category_by_ID($data['category_id']);

					if(isset($cat_name) && !is_wp_error($cat_name)) {
						echo '<br>' . esc_html__('Category', 'shopengine') .' : '. esc_html($cat_name);
					}
				}
				break;

			case 'builder':
				$builder = Helper::get_template_builder_type($post_id);;
				echo empty($builder) ? 'elementor' : $builder;
				break;

			case 'set_default':

				if($template_id == $post_id && class_exists($template_class)) {
					echo '<span class="shopengine_default cat__'.$category.' type-'.esc_attr($template_type).' shopengine-active"> ' . esc_html__('Active', 'shopengine') . ' </span>';
				} else {
					echo '<span class="shopengine_default cat__'.$category.' type-'.esc_attr($template_type).'  shopengine-deactive"> ' . esc_html__('Inactive', 'shopengine') . ' </span>';
				}
				break;
		}
	}


	/**
	 * Public function add_filter.
	 * Added search filter for type of template
	 *
	 * @since 1.0.0
	 */
	public function add_filter() {

		global $typenow;

		if($typenow == Template_Cpt::TYPE) {

			$selected = isset($_GET['type']) ? sanitize_key($_GET['type']) : ''; ?>

            <select name="type" id="type">

                <option value="all" <?php selected('all', $selected); ?>><?php esc_html_e('Template Type ', 'shopengine'); ?></option> <?php

				foreach(Templates::get_template_types() as $key => $value) { ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $selected); ?>><?php esc_html_e($value['title'], 'shopengine'); ?></option>
				<?php } ?>

            </select>
			<?php
		}
	}


	/**
	 * Public function query_filter.
	 * Search query filter added in search query
	 *
	 * @param $query
	 * @since 1.0.0
	 */
	public function query_filter($query) {

		global $pagenow;

		$current_page = isset($_GET['post_type']) ? sanitize_key($_GET['post_type']) : '';

		if(
			is_admin()
			&& Template_Cpt::TYPE == $current_page
			&& 'edit.php' == $pagenow
			&& isset($_GET['type'])
			&& $_GET['type'] != ''
			&& $_GET['type'] != 'all'
		) {
			$type                              = isset($_GET['type']) ? sanitize_key($_GET['type']) : '';
			$query->query_vars['meta_key']     = Action::get_meta_key_for_type();
			$query->query_vars['meta_value']   = $type;
			$query->query_vars['meta_compare'] = '=';
		}
	}


	/**
	 * Public function template_selected.
	 * add meta box for choose template ShopEngine
	 *
	 * @since 1.0.0
	 */
	public function template_selected() {
		global $post;

		if(in_array($post->post_type, $this->actionPost_type)):
			foreach($this->actionPost_type as $k => $v):
				add_meta_box(
					'shopengine_template',
					esc_html__('ShopEngine Template', 'shopengine'),
					[$this, 'shopengine_template'],
					$v,
					'side',
					'low'
				);
			endforeach;
		endif;
	}


	/**
	 * Public function template_save.
	 * ShopEngine Template save for product
	 *
	 * @since 1.0.0
	 */
	public function template_save($post_id, $post) {
		if(!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		if(in_array($post->post_type, $this->actionPost_type)):
			if(isset($_POST['shopengine-template'])) {
				update_post_meta($post_id, Action::PK__SHOPENGINE_TEMPLATE . '__template', sanitize_key($_POST['shopengine-template']));
			}
		endif;
	}


	/**
	 * Public function shopengine_template.
	 * ShopEngine Template Html
	 *
	 * @since 1.0.0
	 */
	public function shopengine_template() {
		global $post;

		if(!isset($post->ID)) {
			return '';
		}

		$page_template = get_post_meta($post->ID, Action::PK__SHOPENGINE_TEMPLATE . '__template', true);

		$template = $this->get_post_single();
		echo '<select name="shopengine-template">';
		echo '<option value="0"> ' . esc_html__('Default', 'shopengine') . ' </option>';
		if(is_array($template) && sizeof($template) > 0) {
			foreach($template as $k => $v) {
				$select = '';
				if($page_template == $k) {
					$select = 'selected';
				}
				echo '<option value="' . $k . '" ' . $select . '> ' . esc_html($v, 'shopengine') . ' </option>';
			}
		}
		echo '</select>';
	}


	/**
	 * get query post query
	 *
	 * @return array
	 */
	public function get_post_single() {

		$args['post_status'] = 'publish';
		$args['post_type']   = Template_Cpt::TYPE;
		$args['meta_query']  = [
			'relation' => 'AND',
			[
				'key'     => Action::get_meta_key_for_type(),
				'value'   => 'single',
				'compare' => '=',
			],
		];

		$posts   = get_posts($args);
		$options = [];
		$count   = count($posts);
		if($count > 0):
			foreach($posts as $post) {
				$options[$post->ID] = $post->post_title;
			}
		endif;

		return $options;
	}
}
