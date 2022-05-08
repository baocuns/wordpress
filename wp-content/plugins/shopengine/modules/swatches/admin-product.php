<?php

namespace ShopEngine\Modules\Swatches;

use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

class Admin_Product {

	use Singleton;

	public function init() {

		add_action('woocommerce_product_option_terms', [$this, 'get_option_terms_product'], 10, 2);

		add_action('wp_ajax_shopengine_add_new_attribute', [$this, 'add_attribute_by_ajax']);

		add_action('admin_footer', [$this, 'shopengine_term_template']);
	}


	public function get_option_terms_product($taxonomy, $index) {

		$types = Swatches::instance()->get_available_types();

		if(!array_key_exists($taxonomy->attribute_type, $types)) {
			return;
		}

		$taxonomy_name = wc_attribute_taxonomy_name($taxonomy->attribute_name);

		global $thepostid;

		$product_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : $thepostid; ?>

        <select multiple="multiple" data-placeholder="<?php esc_attr_e('Select terms', 'shopengine'); ?>"
                class="multiselect attribute_values wc-enhanced-select"
                name="attribute_values[<?php echo esc_attr( $index ); ?>][]">
			<?php

			$all_terms = get_terms($taxonomy_name, apply_filters('woocommerce_product_attribute_terms', ['orderby' => 'name', 'hide_empty' => false]));

			if($all_terms) {
				foreach($all_terms as $term) {
					echo '<option value="' . esc_attr($term->term_id) . '" ' . selected(has_term(absint($term->term_id), $taxonomy_name, $product_id), true, false) . '>' . esc_html(apply_filters('woocommerce_product_attribute_term_name', $term->name, $term)) . '</option>';
				}
			}
			?>
        </select>
        <button class="button plus select_all_attributes"><?php esc_html_e('Select all', 'shopengine'); ?></button>
        <button class="button minus select_no_attributes"><?php esc_html_e('Select none', 'shopengine'); ?></button>
        <button class="button fr plus shopengine_assign_new_attribute" data-type="<?php echo esc_attr( $taxonomy->attribute_type ) ?>">
			<?php esc_html_e('Add new', 'shopengine'); ?>
        </button>

		<?php
	}


	public function add_attribute_by_ajax() {

		$nonce  = isset($_POST['nonce']) ? sanitize_key($_POST['nonce']) : '';
		$tax    = isset($_POST['taxonomy']) ? sanitize_key($_POST['taxonomy']) : '';
		$type   = isset($_POST['type']) ? sanitize_key($_POST['type']) : '';
		$name   = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
		$slug   = isset($_POST['slug']) ? sanitize_key($_POST['slug']) : '';
		$swatch = isset($_POST['swatch']) ? sanitize_text_field($_POST['swatch']) : '';

		if(!wp_verify_nonce($nonce, 'shopengine_nonce_add_attribute')) {
			wp_send_json_error(esc_html__('Request denied', 'shopengine'));
		}

		if(empty($name) || empty($swatch) || empty($tax) || empty($type)) {
			wp_send_json_error(esc_html__('Insufficient data', 'shopengine'));
		}

		if(!taxonomy_exists($tax)) {
			wp_send_json_error(esc_html__('Taxonomy is not exists', 'shopengine'));
		}

		if(term_exists($name, $tax)) {
			wp_send_json_error(esc_html__('Term already exists', 'shopengine'));
		}

		$term = wp_insert_term($name, $tax, ['slug' => $slug]);

		if(is_wp_error($term)) {

			wp_send_json_error($term->get_error_message());

		} else {
			$term = get_term_by('id', $term['term_id'], $tax);
			update_term_meta($term->term_id, $type, $swatch);
		}

		wp_send_json_success(
			[
				'msg'  => esc_html__('Successfully added', 'shopengine'),
				'id'   => $term->term_id,
				'slug' => $term->slug,
				'name' => $term->name,
			]
		);
	}


	public function shopengine_term_template() {

		global $pagenow, $post;

		if($pagenow != 'post.php' || (isset($post) && get_post_type($post->ID) != 'product')) {
			return;
		}
		?>

        <div id="shopengine_tpl_modal" class="shopengine_modal_container">
            <div class="shopengine_modal">
                <button type="button" class="button-link media-modal-close shopengine_modal__close">
                    <span class="media-modal-icon"></span></button>
                <div class="shopengine_modal__header"><h2><?php esc_html_e('Add new term', 'shopengine') ?></h2></div>
                <div class="shopengine_modal__content">
                    <p class="shopengine_term__name">
                        <label>
							<?php esc_html_e('Name', 'shopengine') ?>
                            <input type="text" class="shopengine__input" name="name">
                        </label>
                    </p>
                    <p class="shopengine_term__slug">
                        <label>
							<?php esc_html_e('Slug', 'shopengine') ?>
                            <input type="text" class="shopengine__input" name="slug">
                        </label>
                    </p>
                    <div class="shopengine_term__swatch">

                    </div>
                    <div class="hidden shopengine_term__tax"></div>

                    <input type="hidden" class="shopengine__input" name="nonce"
                           value="<?php echo wp_create_nonce('shopengine_nonce_add_attribute') ?>">
                </div>
                <div class="shopengine_modal__footer">
                    <button class="button button-secondary shopengine_modal__close"><?php esc_html_e('Cancel', 'shopengine') ?></button>
                    <button class="button button-primary shopengine_add_attribute_submit"><?php esc_html_e('Add New', 'shopengine') ?></button>
                    <span class="message"></span>
                    <span class="spinner"></span>
                </div>
            </div>
            <div class="shopengine_modal__backdrop media-modal-backdrop"></div>
        </div>

        <script type="text/template" id="tmpl-shopengine__tpl_input__color">

            <label><?php esc_html_e('Color', 'shopengine') ?></label><br>
            <input type="text" class="shopengine__input shopengine_input__color" name="swatch">

        </script>

        <script type="text/template" id="tmpl-shopengine__tpl_input__image">

            <label><?php esc_html_e('Image', 'shopengine') ?></label><br>

            <div class="shopengine_term_img_thumbnail" style="float:left;margin-right:10px;">
                <img src="<?php echo esc_url(Helper::get_dummy()) ?>" width="60px" height="60px"/>
            </div>

            <div style="line-height:60px;">
                <input type="hidden" class="shopengine__input shopengine_input__image shopengine_term_img" name="swatch" value=""/>

                <button type="button" class="shopengine_upload_img_button button">
					<?php esc_html_e('Upload/Add image', 'shopengine'); ?>
                </button>

                <button type="button" class="shopengine_remove_img_btn button hidden">
					<?php esc_html_e('Remove image', 'shopengine'); ?>
                </button>
            </div>

        </script>

        <script type="text/template" id="tmpl-shopengine__tpl_input__label">

            <label>
				<?php esc_html_e('Label', 'shopengine') ?>
                <input type="text" class="shopengine__input shopengine_input__label" name="swatch">
            </label>

        </script>

        <script type="text/template" id="tmpl-shopengine__tpl_input__tax">

            <input type="hidden" class="shopengine__input" name="taxonomy" value="{{data.tax}}">
            <input type="hidden" class="shopengine__input" name="type" value="{{data.type}}">

        </script>
		<?php
	}
}

