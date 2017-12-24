<?php
namespace Src\Api\Repositories;
use Src\Api\Common\DbConnector;
class Dht11SensorRepository implements Repository
{
    use RepositoryLauncher;
    private $dbConnector;
    private static $instance;
    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new Dht11SensorRepository();
        }
        return self::$instance;
    }
    private function __construct (){
        $this->dbConnector = DbConnector::getInstance();
    }
    public function findAll($limit = 50){
        $stmt = $this->dbConnector->pdo->prepare('SELECT `id`, `temp`, `humidity`, `instant` FROM `dht11_sensor_mesures` order by `instant` desc limit :maxRows');
        $limit = intval($limit, 10);
        $stmt->bindParam(':maxRows', $limit, \PDO::PARAM_INT);
        RepositoryLauncher::launch($stmt);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function findOne($id=0){
        $stmt = $this->dbConnector->pdo->prepare('SELECT `id`, `temp`, `humidity`, `instant` FROM `dht11_sensor_mesures`  WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        RepositoryLauncher::launch($stmt);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }
    public function save($object=[]){
        $stmt = $this->dbConnector->pdo->prepare('INSERT INTO dht11_sensor_mesures(`id`, `temp`, `humidity`, `instant`)  VALUES (:id, :temp, :humidity, :instant)');
        $stmt->bindParam('id', $object->id, \PDO::PARAM_STR);
        $stmt->bindParam('temp', $object->temp, \PDO::PARAM_STR);
        $stmt->bindParam('humidity', $object->humidity, \PDO::PARAM_STR);
        $stmt->bindParam('instant', $object->instant, \PDO::PARAM_STR);
        RepositoryLauncher::launch($stmt);
        return $this->dbConnector->pdo->lastInsertId();
    }
    public function update($object=[]){
        $stmt = $this->dbConnector->pdo->prepare('UPDATE `dht11_sensor_mesures` SET  `temp` = :temp,  `humidity` = :humidity,  instant = :instant WHERE id = :id');
        $stmt->bindParam(':id', $object->id, \PDO::PARAM_INT);
        $stmt->bindParam('temp', $object->temp, \PDO::PARAM_STR);
        $stmt->bindParam('humidity', $object->humidity, \PDO::PARAM_STR);
        $stmt->bindParam('instant', $object->instant, \PDO::PARAM_INT);
        RepositoryLauncher::launch($stmt);
        return $stmt->rowCount();
    }
    public function delete($id=0){
        $stmt = $this->dbConnector->pdo->prepare('DELETE FROM `dht11_sensor_mesures`  WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        RepositoryLauncher::launch($stmt);
        return $stmt->rowCount();
    }
}