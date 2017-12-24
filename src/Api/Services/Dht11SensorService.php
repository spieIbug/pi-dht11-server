<?php
/**
 * Created by PhpStorm.
 * User: ng-dev
 * Date: 18/08/17
 * Time: 12:24
 */

namespace Src\Api\Services;


use Src\Api\Repositories\Dht11SensorRepository;

class Dht11SensorService implements Service
{
    private $repository;
    private static $instance;
    public static function getInstance()
    {
        if (self::$instance==null){
            self::$instance = new Dht11SensorService();
        }
        return self::$instance;
    }

    private function __construct (){
        $this->repository = Dht11SensorRepository::getInstance();
    }
    public function findAll($limit = 50){
        $objects = $this->repository->findAll($limit);
        return array_reverse($objects);
    }
    public function findOne($id){
        $object = $this->repository->findOne($id);
        return $object;
    }
    public function save($object){
        $result = $this->repository->save($object);
        return $result;
    }
    public function update($object){
        $result = $this->repository->update($object);
        return $result;
    }
    public function delete($id){
        $result = $this->repository->delete($id);
        return $result;
    }
}