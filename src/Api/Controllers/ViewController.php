<?php
namespace Src\Api\Controllers;


class ViewController
{
    public function __construct()
    {
    }
    public function index(){
        session_start();
        if (isset($_SESSION['id'])) {
            include('./webapp/index.html');
        } else {
            include('./webapp/login.html');
        }
    }
}