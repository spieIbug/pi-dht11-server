<?php
namespace Src\Api\Repositories;
use Src\Api\Common\DbConnector;
class AuthenticationRepository
{
    use RepositoryLauncher;
    private $dbConnector;
    private static $instance;
    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new AuthenticationRepository();
        }
        return self::$instance;
    }
    private function __construct (){
        $this->dbConnector = DbConnector::getInstance();
    }
    public function authenticate($username){
        $stmt = $this->dbConnector->pdo->prepare('SELECT `id`, `username`, `password` FROM `users` where `username` = :username');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        RepositoryLauncher::launch($stmt);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }

    public function save($username, $password){
        $stmt = $this->dbConnector->pdo->prepare('INSERT INTO users(`username`, `password`)  VALUES (:username, :password)');
        $stmt->bindParam('username', $username, \PDO::PARAM_STR);
        $stmt->bindParam('password', $password, \PDO::PARAM_STR);
        RepositoryLauncher::launch($stmt);
        return $this->dbConnector->pdo->lastInsertId();
    }
    
}