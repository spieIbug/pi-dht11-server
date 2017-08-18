<?php
namespace Src\Api\Common;
class RouterException extends \Exception
{
    public function __construct($message, $code=400){
        parent::__construct($message, $code);
        http_response_code($code);
    }
}