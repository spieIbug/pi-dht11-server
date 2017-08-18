<?php
namespace Src\Api\Controllers;
class JsonController
{
    public function __construct()
    {
        header('Content-type: application/json; charset=UTF-8');
    }

    /**
     * Extrat a json form application/json header
     * can return null for non parsable json
     * @return mixed
     */
    protected function getDataFromJsonHeader()
    {
        $json = file_get_contents('php://input');
        $json = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($json));
        return json_decode($json);
    }

    protected function respondSuccess($msg, $data = [])
    {
        $response = array(
            "error" => false,
            "message" => $msg,
            "data" => $data
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}