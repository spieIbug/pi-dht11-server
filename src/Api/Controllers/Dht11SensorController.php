<?php

namespace Src\Api\Controllers;
use Src\Api\Services\Dht11SensorService;
use Src\Api\Filters\MovinAverageFilter;

class Dht11SensorController extends JsonController implements Controller
{
    private $service;
    private $movinAverageFilter;

    public function __construct (){
        parent::__construct();
        $this->service = Dht11SensorService::getInstance();
        $this->movinAverageFilter = new MovinAverageFilter();
    }
    public function findAll($limit = 50){
        $objects = $this->service->findAll($limit);
        $this->respondSuccess("sensors mesures", $objects);
    }
    public function findOne($id){
        $object = $this->service->findOne($id);
        $this->respondSuccess("sensor mesures", $object);
    }
    public function save(){
        $object = parent::getDataFromJsonHeader();
        // $object = $this->movinAverageFilter->filter($object);
        if ($object != NULL) {
            $result = $this->service->save($object);
            $this->respondSuccess("sensor mesure saved", $result);
        }
        $this->respondSuccess("sensor mesure saved", 15);
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