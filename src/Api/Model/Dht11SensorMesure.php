<?php
namespace Src\Api\Model;
class Dht11SensorMesure {
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @var string
     * @ORM\Column(name="temp", type="string", nullable=false )
     */
    public $temp;
    /**
     * @var string
     * @ORM\Column(name="humidity", type="string", nullable=false )
     */
    public $humidity;

    /**
     * @var string
     * @ORM\Column(name="instant", type="date", nullable=false )
     */
    public $instant;

}