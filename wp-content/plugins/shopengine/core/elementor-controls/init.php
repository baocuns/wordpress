<?php 
namespace ShopEngine\Core\Elementor_Controls;

defined( 'ABSPATH' ) || exit;

class Init{

    // instance of all control's base class
    public static function get_url(){
        return \ShopEngine::core_url() . 'elementor-controls/';
    }
    public static function get_dir(){
        return \ShopEngine::core_dir() . 'elementor-controls/';
    }

    public function __construct() {

        // Includes necessary files
        $this->include_files();
        
        // Initilizating control hooks
        add_action('elementor/controls/controls_registered', array( $this, 'image_choose' ), 12 );
        add_action('elementor/controls/controls_registered', array( $this, 'ajax_select2' ), 12 );
    }

    private function include_files(){
        // Controls_Manager
        include_once self::get_dir() . 'control-manager.php';

        // image choose
        include_once self::get_dir() . 'image-choose.php';

        // ajax select2
        include_once self::get_dir() . 'ajax-select2.php';
    }

    public function image_choose( $controls_manager ) {
        $controls_manager->register_control('imagechoose', new \ShopEngine\Core\Elementor_Controls\Image_Choose());
    }

    public function ajax_select2( $controls_manager ) {
        $controls_manager->register_control('ajaxselect2', new \ShopEngine\Core\Elementor_Controls\Ajax_Select2());
    }
}
