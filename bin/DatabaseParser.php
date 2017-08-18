<?php
namespace bin;
class DatabaseParser {
    private static $instance;
    public $pdo;
    public static function getInstance($config_path =""){
        if (is_null(self::$instance)) {
            self::$instance = new DatabaseParser($config_path);
        }
        return self::$instance;
    }
    private function __construct($config_path){
        $db_config = file_get_contents($config_path);
        if (!$db_config){
            http_response_code(500);
            echo "{\"error\":true, \"message\":\"database config mismatch\"}";
            return;
        }
        $GLOBALS['DB_CONFIG'] = json_decode($db_config, true);
        if ($GLOBALS['DB_CONFIG']==NULL){
            http_response_code(500);
            echo "{\"error\":true, \"message\":\"database config parse error\"}";
            return;
        }
    }
}