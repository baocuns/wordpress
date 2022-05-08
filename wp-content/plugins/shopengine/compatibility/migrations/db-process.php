<?php 
namespace ShopEngine\Compatibility\Migrations;
defined('ABSPATH') || exit;
class Db_Process{
    private $widget_names;
    private $new_widget_names;
    private $metadata;

    public function __construct(){
        $this->set_widget_names();
        $this->process_post_meta_data();

        foreach($this->metadata as $data){
            $this->migrate_metadata($data);
        }
    }

    private function migrate_metadata($data){
        $new_meta_value = str_replace($this->widget_names, $this->new_widget_names, $data->meta_value);

        global $wpdb;
        $update = ['meta_value' => $new_meta_value];
        $where = ['meta_id' => $data->meta_id];
        $wpdb->update($wpdb->postmeta , $update, $where);
    }

    private function process_post_meta_data(){
        global $wpdb;
        $this->metadata = $wpdb->get_results ( "
            SELECT * 
            FROM  $wpdb->postmeta
                WHERE meta_key = '_elementor_data'
        " );
    }

    private function set_widget_names(){
        $names = array_keys(\ShopEngine\Core\Register\Widget_List::instance()->get_list());

        $this->widget_names = preg_filter('/^.*$/', '"widgetType":"$0"', $names);
        $this->new_widget_names = preg_filter('/^.*$/', '"widgetType":"shopengine-$0"', $names);
    }
}