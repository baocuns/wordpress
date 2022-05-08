<?php

namespace ShopEngine\Core\Builders;

use ShopEngine\Core\Template_Cpt;
use ShopEngine\Traits\Singleton;

defined('ABSPATH') || exit;

class Action
{
    use Singleton;

    const PK__SHOPENGINE_TEMPLATE = 'shopengine_template__post_meta';
    const EDIT_WITH_GUTENBERG     = 'gutenberg';
    const EDIT_WITH_ELEMENTOR     = 'elementor';

    /**
     * @var mixed
     */
    private $form_id;
    /**
     * @var mixed
     */
    private static $form_settings;
    /**
     * @var string
     */
    private static $edit_with = '';

    /**
     * @param $form_id
     * @param $form_settings
     * @return mixed
     */
    public function store($form_id, $form_settings)
    {
        $this->set_form_values($form_settings);
        $this->form_id = $form_id;

        if ($this->form_id == 0) {
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
            $wp_rewrite->init();

            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function insert()
    {
        $form_settings = self::$form_settings;

        $title = ($form_settings['form_title'] != '') ? $form_settings['form_title'] : 'New Template # ' . time();

        $form_id = wp_insert_post([
            'post_title'  => $title,
            'post_status' => 'publish',
            'post_type'   => Template_Cpt::TYPE
        ]);

        /**
         * Get template default meta
         */
        $edit_with     = self::get_form_value('edit_with_option', self::EDIT_WITH_GUTENBERG);
        $default       = self::get_form_value('set_default', 'No');
        $template_type = self::get_form_value('form_type', 'single');
        $category_id   = !empty($form_settings['category_id']) ? '__' . $form_settings['category_id'] : '';

        /**
         * Set template default meta
         */
        update_post_meta($form_id, self::get_meta_key_for_type(), $template_type);
        update_post_meta($form_id, self::PK__SHOPENGINE_TEMPLATE, $form_settings);
        update_post_meta($form_id, self::get_meta_key_for_edit_with(), $edit_with);

        $this->conditional_template($template_type);
        /**
         * Template active status checking
         */
        if ($default == 'Yes') {
            /**
             * Generate created template type key
             */
            $template_key_type = self::PK__SHOPENGINE_TEMPLATE . '__' . $template_type . $category_id;

            
            update_option($template_key_type, $form_id);
        }
        
        /**
         * If this template is dependent on elementor page builder then this meta will be saved
         */
        if ($edit_with === self::EDIT_WITH_ELEMENTOR) {
            /**
             * Auto elementor canvas style
             */
            if (in_array($template_type, ['quick_checkout', 'quick_view'])) {
                update_post_meta($form_id, '_wp_page_template', 'elementor_canvas');
            } else {
                update_post_meta($form_id, '_wp_page_template', 'elementor_header_footer');
            }
            update_post_meta($form_id, '_elementor_edit_mode', 'builder');
            update_post_meta($form_id, '_elementor_version', '3.4.6');
        }

        if (!empty($form_settings['sample_design'])) {

            /**
             *  Get ready made template data
             */
            $design_data = \ShopEngine\Core\Sample_Designs\Base::instance()->get_design_data($form_settings['sample_design']);

            if (!is_null($design_data)) {
                /**
                 *  for unicode character support
                 */
                $design_data = wp_slash(wp_json_encode($design_data));

                update_post_meta($form_id, '_elementor_data', $design_data);
            }
        }

        return [
            'saved'  => true,
            'data'   => [
                'id'    => $form_id,
                'title' => $title,
                'type'  => Template_Cpt::TYPE
            ],
            'status' => esc_html__('Template settings inserted', 'shopengine')
        ];
    }

    public function update()
    {
        $form_settings = self::$form_settings;

        $title = ($form_settings['form_title'] != '') ? $form_settings['form_title'] : 'New Template # ' . time();

        wp_update_post([
            'ID'          => $this->form_id,
            'post_title'  => $title,
            'post_status' => 'publish'
        ]);

        /**
         * Get template default meta
         */
        $default       = self::get_form_value('set_default', 'No');
        $template_type = self::get_form_value('form_type', 'single');
        $category_id   = !empty($form_settings['category_id']) ? '__' . $form_settings['category_id'] : '';

        $form_settings['set_default'] = $default;

        $old_form_settings = get_post_meta($this->form_id, self::PK__SHOPENGINE_TEMPLATE, true);
        update_post_meta($this->form_id, self::PK__SHOPENGINE_TEMPLATE, $form_settings);
        update_post_meta($this->form_id, self::get_meta_key_for_type(), $template_type);

        /**
         * Generate created template type key
         */
        $template_key_type = self::PK__SHOPENGINE_TEMPLATE . '__' . $template_type . $category_id;

        $this->conditional_template($template_type, $old_form_settings);
        /**
         * Template active status checking
         */
        if ($default == 'Yes') {
            update_option($template_key_type, $this->form_id);

        } elseif ($default == 'No') {
            update_option($template_key_type, 0);
        }
        

        return [
            'saved'  => true,
            'data'   => [
                'id'    => $this->form_id,
                'title' => $title,
                'type'  => Template_Cpt::TYPE
            ],
            'status' => esc_html__('Template settings updated', 'shopengine')
        ];
    }

    /**
     * @param $template_type
     * @param array $old_form_settings
     */
    public function conditional_template($template_type, $old_form_settings = [])
    {

        $form_settings = self::$form_settings;
        
        if ($template_type === 'single' || $template_type === 'archive') {

            if (!empty($form_settings['category_id']) && !empty($old_form_settings['category_id'])) { // category to category

                if ($old_form_settings['category_id'] != $form_settings['category_id']) {

                    $old_template_key_type = self::PK__SHOPENGINE_TEMPLATE . '__' . $template_type . '__' . $old_form_settings['category_id'];

                    $old_template_id = get_option($old_template_key_type);

                    if ($old_template_id == $this->form_id) {
                        update_option($old_template_key_type, 0);
                    }
                }

            } elseif (!empty($old_form_settings['category_id'])) { // category to normal

                $old_template_key_type = self::PK__SHOPENGINE_TEMPLATE . '__' . $template_type . '__' . $old_form_settings['category_id'];

                $old_template_id = get_option($old_template_key_type);

                if ($old_template_id == $this->form_id) {
                    update_option($old_template_key_type, 0);
                }

            } else { // normal to category

                $template_id_with_out_category = get_option(self::PK__SHOPENGINE_TEMPLATE . '__' . $template_type);

                if ($this->form_id == $template_id_with_out_category) {
                    update_option(self::PK__SHOPENGINE_TEMPLATE . '__' . $template_type, 0);
                }
            }
        }
    }

    /**
     * @param $post_id
     * @return mixed
     */
    public function get_all_data($post_id)
    {
        $post                     = get_post($post_id);
        $data                     = get_post_meta($post->ID, self::PK__SHOPENGINE_TEMPLATE, true);
        $type                     = get_post_meta($post->ID, self::get_meta_key_for_type(), true);
        $data['form_title']       = get_the_title($post_id);
        $data['set_default']      = 'No';
        $data['edit_with_option'] = get_post_meta($post->ID, self::get_meta_key_for_edit_with(), true);

        if (!empty($data['category_id'])) {

            $category = '__' . $data['category_id'];
            $saved_id = get_option(Action::PK__SHOPENGINE_TEMPLATE . '__' . $type . $category, 0);

            if ($saved_id == $post->ID) {
                $data['set_default'] = 'Yes';
            }

        } else {
            if (Templates::get_registered_template_id($type) == $post->ID) {
                $data['set_default'] = 'Yes';
            }
        }
        return $data;
    }

    public static function get_meta_key_for_type()
    {
        return self::PK__SHOPENGINE_TEMPLATE . '__type';
    }

    public static function get_meta_key_for_edit_with()
    {
        return self::PK__SHOPENGINE_TEMPLATE . '__edit_with';
    }

    /**
     * @param $template_id
     */
    public static function edit_with($template_id)
    {
        if (static::$edit_with) {
            return static::$edit_with;
        }

        $edit_with         = get_post_meta($template_id, Action::get_meta_key_for_edit_with(), true);
        static::$edit_with = empty($edit_with) ? Action::EDIT_WITH_ELEMENTOR : $edit_with;

        return static::$edit_with;
    }

    /**
     * @param $pid
     * @return mixed
     */
    public static function is_edit_with_gutenberg($pid)
    {
        $edit_with = get_post_meta($pid, Action::get_meta_key_for_edit_with(), true);
        $edit_with = empty($edit_with) ? Action::EDIT_WITH_ELEMENTOR : $edit_with;

        return $edit_with === self::EDIT_WITH_GUTENBERG;
    }

    /**
     * @param $field
     * @param $default
     */
    private static function get_form_value($field, $default = '')
    {
        return isset(self::$form_settings[$field]) ? self::$form_settings[$field] : $default;
    }

    /**
     * @param $form_settings
     * @param $fields
     */
    private function set_form_values($form_settings, $fields = null)
    {
        $fields = $this->get_fields();

        foreach ($form_settings as $key => $value) {

            if (isset($fields[$key])) {
                self::$form_settings[$key] = $value;
            }
        }
    }

    public function get_fields()
    {
        return [
            'form_title'       => [
                'name' => 'form_title'
            ],
            'form_type'        => [
                'name' => 'form_type'
            ],
            'set_default'      => [
                'name' => 'set_default'
            ],
            'edit_with_option' => [
                'name' => 'edit_with_option'
            ],
            'sample_design'    => [
                'name' => 'sample_design'
            ],
            'category_id'      => [
                'name' => 'category_id'
            ]
        ];
    }
}
