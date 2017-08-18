<?php
namespace Src\Api\Controllers;


class ViewController
{
    public function __construct()
    {
    }
    public function index(){
        include('./webapp/index.html');
    }
}