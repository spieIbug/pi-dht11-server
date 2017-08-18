<?php
namespace Src\Api\Common;
class DbConnector {
    private static $instance;
    public $pdo;
    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new DbConnector($GLOBALS['DB_CONFIG']['username'], $GLOBALS['DB_CONFIG']['password']);
        }
        return self::$instance;
    }
    private function __construct($username="root", $password=""){
        try {
            $dsn = "mysql:dbname=".$GLOBALS['DB_CONFIG']['database_name'].";host=".$GLOBALS['DB_CONFIG']['host'];
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw  new \Exception($e->getMessage(), $e->getCode());
        }
    }
}