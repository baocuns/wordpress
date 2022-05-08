<?php

namespace ShopEngine\Modules\Swatches;

use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

class Attribute_Hooks {

	use Singleton;

	public function init() {

		$attribute_taxonomies = wc_get_attribute_taxonomies();
		$types                = Swatches::instance()->get_available_types();

		if(empty($attribute_taxonomies)) {
			return;
		}

		foreach($attribute_taxonomies as $tax) {

			if(isset($types[$tax->attribute_type])) {

				if(Swatches::PA_LABEL === $tax->attribute_type) {
					$col = 'label_attribute_column';

				} elseif(Swatches::PA_COLOR === $tax->attribute_type) {
					$col = 'color_attribute_column';
					
				} else {
					$col = 'image_attribute_column';
				}
				
				add_filter('manage_edit-pa_' . $tax->attribute_name . '_columns', [$this, $col]);
				add_filter('manage_pa_' . $tax->attribute_name . '_custom_column', [$this, 'add_attr_column_content'], 10, 3);

				add_action('pa_' . $tax->attribute_name . '_add_form_fields', [$this, 'add_attr_field']);
				add_action('pa_' . $tax->attribute_name . '_edit_form_fields', [$this, 'edit_attr_field'], 10, 2);
			}
		}

		add_action('created_term', [$this, 'persist_term_meta'], 10, 2);
		add_action('edit_term', [$this, 'persist_term_meta'], 10, 2);
		add_action('shopengine_attribute_field_chain', [$this, 'attribute_fields'], 10, 3);
	}


	public function add_attr_field($taxonomy) {

		$attr = Helper::get_tax_attribute($taxonomy);

		do_action('shopengine_attribute_field_chain', $attr->attribute_type, '', 'add');
	}


	public function edit_attr_field($term, $taxonomy) {

		$attr = Helper::get_tax_attribute($taxonomy);

		$value = get_term_meta($term->term_id, $attr->attribute_type, true);

		do_action('shopengine_attribute_field_chain', $attr->attribute_type, $value, 'edit');
	}

	public function label_attribute_column($columns) {
		$th = esc_html__('Label', 'shopengine');
		return $this->add_attr_column($columns, $th);
	}

	public function image_attribute_column($columns) {
		$th = esc_html__('Thumbnail', 'shopengine');
		return $this->add_attr_column($columns, $th);
	}

	public function color_attribute_column($columns) {
		$th = esc_html__('Color', 'shopengine');
		return $this->add_attr_column($columns, $th);
	}

	/**
	 * Add another td in the table
	 *
	 * @param $columns
	 * @return mixed
	 */
	public function add_attr_column($columns, $th = '') {
		$new_columns = [];

		if(isset($columns['cb'])) {
			$new_columns['cb'] = $columns['cb'];
		}

		$new_columns['pa_preview'] = $th;
		unset($columns['cb']);

		return $new_columns + $columns;
	}


	public function add_attr_column_content($columns, $column, $term_id) {

		if('pa_preview' !== $column) {
			return $columns;
		}


		$attr = Helper::get_tax_attribute(sanitize_key($_REQUEST['taxonomy']));

		$value = get_term_meta($term_id, $attr->attribute_type, true);

		switch($attr->attribute_type) {
			case Swatches::PA_COLOR:
				printf('<div class="swatches_thumb swatch_color" style="background-color:%s;"></div>', esc_attr($value));
				break;

			case Swatches::PA_IMAGE:
				$image = $value ? wp_get_attachment_image_src($value) : '';
				$image = $image ? $image[0] : Helper::get_dummy();
				printf('<img class="swatches_thumb swatch_image" src="%s" width="44px" height="44px">', esc_url($image));
				break;

			case Swatches::PA_LABEL:
				printf('<div class="swatch_label">%s</div>', esc_html($value));
				break;
		}

		return $columns;
	}


	public function persist_term_meta($term_id, $tt_id) {

		$types = Swatches::instance()->get_available_types();

		foreach($types as $type => $label) {
			if(isset($_POST[$type])) {

				if($type == Swatches::PA_COLOR) {

					update_term_meta($term_id, $type, sanitize_hex_color($_POST[$type]));

				} else {

					update_term_meta($term_id, $type, sanitize_text_field($_POST[$type]));
				}
			}
		}
	}


	public function attribute_fields($type, $value, $form) {

		$types         = Swatches::instance()->get_available_types();

		/**
		 * Rejecting all types from other plugin/module
		 *
		 */
		if(!isset($types[$type])) {

			return;
		}

		printf(
			'<%s class="form-field">%s<label for="term-%s">%s</label>%s',
			'edit' == $form ? 'tr' : 'div',
			'edit' == $form ? '<th>' : '',
			esc_attr($type),
			$types[$type],
			'edit' == $form ? '</th><td>' : ''
		);

		switch($type) {
			case Swatches::PA_IMAGE:
				$image = $value ? wp_get_attachment_image_src($value) : '';
				$image = $image ? $image[0] : Helper::get_dummy();
				?>

                <div class="shopengine_term_img_thumbnail" style="float:left;margin-right:10px;">
                    <img alt="" src="<?php echo esc_url($image) ?>" width="70px" height="70px"/>
                </div>

                <div style="line-height:60px;">
                    <input type="hidden" class="shopengine_term_img" name="<?php echo esc_attr($type) ?>"
                           value="<?php echo esc_attr($value) ?>"/>

                    <button type="button" class="shopengine_upload_img_button button">
						<?php esc_html_e('Upload image', 'shopengine'); ?>
                    </button>

                    <button type="button"
                            class="shopengine_remove_img_btn button <?php echo esc_attr($value) ? '' : 'hidden' ?>">
						<?php esc_html_e('Remove image', 'shopengine'); ?>
                    </button>
                </div> <?php

				break;

			case Swatches::PA_COLOR : ?>

                <input type="color"
                       id="term-<?php echo esc_attr($type) ?>"
                       name="<?php echo esc_attr($type) ?>"
                       value="<?php echo esc_attr($value) ?>"/> <?php
				break;

			default: ?>

                <input type="text"
                       id="term-<?php echo esc_attr($type) ?>"
                       name="<?php echo esc_attr($type) ?>"
                       value="<?php echo esc_attr($value) ?>"/> <?php
				break;
		}


		echo 'edit' == $form ? '</td></tr>' : '</div>';
	}
}
