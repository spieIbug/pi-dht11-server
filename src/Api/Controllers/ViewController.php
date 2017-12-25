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
            include('./webapp/index.php');
        } else {
            include('./webapp/login.html');
        }
    }
    public function map(){
        session_start();
        if (isset($_SESSION['id'])) {
            include('./webapp/map.php');
        } else {
            include('./webapp/login.html');
        }
    }
}