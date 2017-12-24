<?php

namespace Src\Api\Services;

use Src\Api\Repositories\AuthenticationRepository;

class AuthenticationService {
    private $repository;
    private static $instance;
    public static function getInstance()
    {
        if (self::$instance==null){
            self::$instance = new AuthenticationService();
        }
        return self::$instance;
    }

    private function __construct (){
        $this->repository = AuthenticationRepository::getInstance();
    }
    
    public function authenticate($username, $clearPassword){
        $result = $this->repository->authenticate($username);
        if ($result != false) {
            if (password_verify($clearPassword, $result["password"])) {
                return $result;
            }
        }
        return null;
    }
}
