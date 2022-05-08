<?php

namespace ShopEngine\Modules\Swatches;

use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

class Frontend
{

	use Singleton;

	public function init() {

		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_filter('woocommerce_dropdown_variation_attribute_options_html', [$this, 'get_swatch_html'], 100, 2);
		add_filter('shopengine_filter_html_swatch_hook', [$this, 'swatch_html'], 5, 4);
	}


	public function enqueue_scripts() {
		wp_enqueue_style('shopengine-css-front', Swatches::asset_source('css', 'frontend.css'), [], Swatches::MODULE_VERSION);
		wp_enqueue_script('shopengine-js-front', Swatches::asset_source('js', 'frontend.js'), ['jquery'], Swatches::MODULE_VERSION, true);
	}


	public function get_swatch_html($html, $args) {

		$swatch_types = Swatches::instance()->get_available_types();

		$attr = Helper::get_tax_attribute($args['attribute']);


		// Return if this is normal attribute
		if(empty($attr)) {
			return $html;
		}


		if(!array_key_exists($attr->attribute_type, $swatch_types)) {
			return $html;
		}


		$options   = $args['options'];
		$product   = $args['product'];
		$attribute = $args['attribute'];
		$class     = "variation-selector variation-select-{$attr->attribute_type}";
		$swatches  = '';

		$args['tooltip'] = $this->is_tooltip_enabled();

		if(empty($options) && !empty($product) && !empty($attribute)) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[$attribute];
		}

		if(array_key_exists($attr->attribute_type, $swatch_types)) {
			if(!empty($options) && $product && taxonomy_exists($attribute)) {
				$terms = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);

				foreach($terms as $term) {
					if(in_array($term->slug, $options)) {
						$swatches .= apply_filters('shopengine_filter_html_swatch_hook', '', $term, $attr->attribute_type, $args);
					}
				}
			}

			if(!empty($swatches)) {
				$class    .= ' hidden';
				$swatches = '<div class="shopengine_swatches" data-attribute_name="attribute_' . esc_attr($attribute) . '">' . $swatches . '</div>';
				$html     = '<div class="' . esc_attr($class) . '">' . $html . '</div>' . $swatches;
			}
		}

		return $html;
	}


	public function swatch_html($html, $term, $type, $args) {

		$selected = sanitize_title($args['selected']) == $term->slug ? 'selected' : '';
		$name     = esc_html(apply_filters('woocommerce_variation_option_name', $term->name));
		$tooltip  = '';

		if(!empty($args['tooltip'])) {
			$tooltip = '<span class="shopengine_swatch__tooltip">' . ($term->description ? $term->description : $name) . '</span>';
		}

		switch($type) {
			case Swatches::PA_COLOR:
				$color = get_term_meta($term->term_id, $type, true);
				list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
				$html = sprintf(
					'<span class="swatch swatch_color swatch-%s %s" style="background-color:%s;color:%s;" data-value="%s">%s%s</span>',
					esc_attr($term->slug),
					$selected,
					esc_attr($color),
					"rgba($r,$g,$b,0.5)",
					esc_attr($term->slug),
					$name,
					$tooltip
				);
				break;

			case Swatches::PA_IMAGE:
				$image = get_term_meta($term->term_id, $type, true);
				$image = $image ? wp_get_attachment_image_src($image) : '';
				$image = $image ? $image[0] : Helper::get_dummy();
				$html  = sprintf(
					'<span class="swatch swatch_image swatch-%s %s" data-value="%s"><img src="%s" alt="%s">%s%s</span>',
					esc_attr($term->slug),
					$selected,
					esc_attr($term->slug),
					esc_url($image),
					esc_attr($name),
					$name,
					$tooltip
				);
				break;

			case Swatches::PA_LABEL:
				$label = get_term_meta($term->term_id, $type, true);
				$label = $label ? $label : $name;
				$html  = sprintf(
					'<span class="swatch swatch_label swatch-%s %s" data-value="%s">%s%s</span>',
					esc_attr($term->slug),
					$selected,
					esc_attr($term->slug),
					esc_html($label),
					$tooltip
				);
				break;
		}

		return $html;
	}


	public function is_tooltip_enabled() {

		return true;
	}
}