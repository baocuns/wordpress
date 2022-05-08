<?php
namespace ShopEngine\Compatibility\Migrations;
defined('ABSPATH') || exit;

/*
Migration::keep_versions('shopengine', '1.2.3');


new Migration('shopengine', 'unique_key', ['\ShonEngine\Class', 'method_name']);
*/

class Migration{

    public static $versions_keep_key = '__installed_versions';
    public static $versions;
    private $textdomain;
    private $migration_key;
    private $migration_class_callback;
    private $migration_logs;
    private $migration_logs_key;

    public function init($textdomain, $migration_key, $migration_class_callback){
        $this->textdomain = $textdomain;
        $this->migration_key = $migration_key;
        $this->migration_logs_key = $textdomain . '__' . $textdomain;
        $this->migration_class_callback = $migration_class_callback;

        $this->process_migration_logs();
        if(!in_array($this->migration_key, $this->migration_logs['migrations_done'])){
            $this->run_migration();
        }
    }

    public static function set_versions($textdomain, $version){
        $versions = self::get_versions($textdomain);
        // need a fallback for < PHP 7.3.1 // https://www.php.net/manual/en/function.array-key-last.php
        $last_version = array_key_last(self::$versions);

        if($last_version != $version){
            return;
        }

        $versions = array_merge($versions, [$version => time()]);
        $version_keep_key = $textdomain . self::$version_keep_key;
        update_option($version_keep_key, $versions);
    }

    public static function get_versions($textdomain){
        $version_keep_key = $textdomain . self::$version_keep_key;
        $versions = get_option($version_keep_key, []);
        return (!is_array($versions) ? [] : $versions);
    }

    private function run_migration(){
        call_user_func($this->migration_class_callback);
        $this->add_migration_logs();
    }

    private function add_migration_logs(){
        $this->migration_logs['migrations_done'][] = $this->migration_key;
        $this->migration_logs['run_last'] = time();
        $this->migration_logs['run_version'] = \ShopEngine::version();

        update_option($this->migration_logs_key, $this->migration_logs);
    }

    private function process_migration_logs(){
        $logs = get_option($this->migration_logs_key);
        if(empty($logs) || !isset($logs['migrations_done'])){
            $logs = [
                'migrations_done' => [],
                'run_last' => 0,
                'run_version' => '0',
            ];

            update_option($this->migration_logs_key, $logs);
        }

        $this->migration_logs = $logs;
    }

}