<?php

namespace Src\Api\Controllers;
use Src\Api\Services\AuthenticationService;

class AuthenticationController {
    private $authenticationService;

    public function __construct (){
        $this->authenticationService = AuthenticationService::getInstance();
    }
    public function authenticate () {
        if ( isset($_POST["username"]) && isset($_POST["password"]) ){
            extract($_POST);
            $result = $this->authenticationService->authenticate($username, $password);
            session_start();
            if ($result != NULL) {
                $_SESSION["id"] = $result["id"];
            }
            header("location:../");
        }
    }
}