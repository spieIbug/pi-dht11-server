<?php

namespace Src\Api\Controllers;
use Src\Api\Services\Dht11SensorService;

class Dht11SensorController extends JsonController implements Controller
{
    private $service;
    public function __construct (){
        parent::__construct();
        $this->service = Dht11SensorService::getInstance();
    }
    public function findAll(){
        $objects = $this->service->findAll();
        $this->respondSuccess("sensors mesures", $objects);
    }
    public function findOne($id){
        $object = $this->service->findOne($id);
        $this->respondSuccess("sensor mesures", $object);
    }
    public function save(){
        $object = parent::getDataFromJsonHeader();
        $result = $this->service->save($object);
        $this->respondSuccess("sensor mesure saved", $result);
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}