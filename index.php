<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define ('SITE_ROOT', realpath(dirname(__FILE__)));
$router = new Src\Api\Router\Router ($_GET['url']);

require 'bin/RouteParser.php';
$databaseParser =  bin\DatabaseParser::getInstance('config/database.json');
$router->get ( '/', function () {header('location:./webapp/');},'AccessPoint');

try {
    $router->run ();
} catch (\Exception $e) {
    http_response_code(400);
    echo "{\"error\":true, \"message\":\"".$e->getMessage()."\"}";
}