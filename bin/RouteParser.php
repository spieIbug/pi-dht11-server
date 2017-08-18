<?php
$routes=file_get_contents("config/routes.json");
if (!$routes){
    http_response_code(500);
    echo "{\"error\":true, \"message\":\"Routes config mismatch\"}";
    return;
}
$routes = json_decode($routes, true);
if ($routes==NULL){
    http_response_code(500);
    echo "{\"error\":true, \"message\":\"Routes config parse error\"}";
    return;
}
$method = $_SERVER["REQUEST_METHOD"];
$routes = $routes[$method];
$routes_count = count($routes);
switch($method){
    case "GET": {
        for ($i=0; $i<$routes_count; $i++) {
            $router->get($routes[$i]['route'], $routes[$i]['controller'].'#'.$routes[$i]['action'],$routes[$i]['name']);
        }
        break;
    }
    case "POST": {
        for ($i=0; $i<$routes_count; $i++) {
            $router->post($routes[$i]['route'], $routes[$i]['controller'].'#'.$routes[$i]['action'],$routes[$i]['name']);
        }
        break;
    }
    case "PUT": {
        for ($i=0; $i<$routes_count; $i++) {
            $router->put($routes[$i]['route'], $routes[$i]['controller'].'#'.$routes[$i]['action'],$routes[$i]['name']);
        }
        break;
    }
    case "DELETE": {
        for ($i=0; $i<$routes_count; $i++) {
            $router->delete($routes[$i]['route'], $routes[$i]['controller'].'#'.$routes[$i]['action'],$routes[$i]['name']);
        }
        break;
    }
    default: {
        throw new Exception("Route mismatch");
    }
}
