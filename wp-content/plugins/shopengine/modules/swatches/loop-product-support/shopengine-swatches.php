<?php

namespace ShopEngine\Modules\Swatches\Loop_Product_Support;


use ShopEngine\Modules\Swatches\Swatches;
use WC_Product_Simple;

class Shopengine_Swatches
{

    private $attribute_taxonomy = [];
    private $attribute_options = [];

    private $color_attribute = 'shopengine_color';
    private $image_attribute = 'shopengine_image';
    private $label_attribute = 'shopengine_label';


    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'add_enqueue']);
        add_action('shopengine_swatches_anywhere', [$this, 'print_attributes'], 10, 2);
    }

    public function add_enqueue()
    {
        wp_enqueue_style('shopengine-swatches-loop-css', Swatches::get_module_uri() . 'loop-product-support/assets/swatches.css', ['wp-color-picker'], time());
        wp_enqueue_script('shopengine-swatches-loop-js', Swatches::get_module_uri() . 'loop-product-support/assets/swatches.js', ['jquery'], '1515155', true);
    }


    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new Shopengine_Swatches();
        }

        return $instance;
    }


    /**
     * @param $product \WC_Product
     * @param $attributes_to_show array
     * @return void
     */
    public function print_attributes($product, $attributes_to_show = ['pa_color'])
    {
        if (!$product->is_type('variable')) {
            return;
        }

        $variation_attributes = $product->get_variation_attributes();

        foreach ($attributes_to_show as $attribute_to_show) {

            $selected_attributes = $variation_attributes[$attribute_to_show];

            $attributes = $product->get_available_variations();
            $attribute_data = [];

            foreach ($attributes as $attribute) {

                $attr_keys = array_keys($attribute['attributes']);

                foreach ($attr_keys as $attr_key) {
                    $attr_value = $attribute['attributes'][$attr_key];
                    if (in_array($attr_value, $selected_attributes)) {

                        $attribute_data[$attr_value]['src'] = $attribute['image']['src'];
                     //   $attribute_data[$attr_value]['srcset'] = $attribute['image']['srcset'];

                    }

                }
            }

            $options = wc_get_product_terms($product->get_id(), $attribute_to_show, array('fields' => 'all'));
            $attr = $this->get_attribute_taxonomy($attribute_to_show);
            $swatches = '';
            foreach ($options as $option) {
                if (isset($attribute_data[$option->slug])) {
                    $swatches .= $this->get_swatches_html($option, $attr->attribute_type);
                }
            }
            if($swatches){
            echo '<div class="shopengine_swatches shopengine_swatches_in_loop shopengine_'.$attribute_to_show.'" data-attribute=' . "'" . json_encode($attribute_data, true) . "'" . ' data-attribute_name="attribute_' . esc_attr($attribute_to_show) . '">' . $swatches . '</div>';
            }
        }
    }


    private function get_attribute_taxonomy($taxonomy)
    {
        if (isset($this->attribute_taxonomy[$taxonomy])) {
            return $this->attribute_taxonomy[$taxonomy];
        }

        global $wpdb;

        $attr = substr($taxonomy, 3);
        return $this->attribute_taxonomy[$taxonomy] = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = %s", $attr));
    }


    private function get_swatches_html($term, $type)
    {
        if (isset($this->attribute_options[$term->slug])) {
            return $this->attribute_options[$term->slug];
        }

        $selected = '';
        $name = $term->name;
        $tooltip = '';
        $html = '';

        switch ($type) {
            case $this->color_attribute:
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

            case $this->image_attribute:
                $image = get_term_meta($term->term_id, $type, true);
                $image = $image ? wp_get_attachment_image_src($image) : '';
                $image = $image ? $image[0] : '';
                $html = sprintf(
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

            case $this->label_attribute:
                $label = get_term_meta($term->term_id, $type, true);
                $label = $label ? $label : $name;
                $html = sprintf(
                    '<span class="swatch swatch_label swatch-%s %s" data-value="%s">%s%s</span>',
                    esc_attr($term->slug),
                    $selected,
                    esc_attr($term->slug),
                    esc_html($label),
                    $tooltip
                );
                break;
        }

        $this->attribute_options[$term->slug] = $html;
        return $html;
    }
}
