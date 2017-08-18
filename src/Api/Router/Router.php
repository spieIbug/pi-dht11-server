<?php
namespace Src\Api\Router;
use Src\Api\Common\RouterException;
class Router{
    private $url;
    private $routes = [];
    private $namedRoutes = [];
    public function __construct($url){
        $this->url = $url;
    }
    /**
     * @param unknown $path : Route URI
     * @param unknown $callable : Callback, can also be a string Example : Foo#bar, FooController and bar method
     * @param unknown $name : optional route name
     */
    public function get($path, $callable, $name=null){
        return $this->add($path, $callable, $name, 'GET');
    }
    /**
     * @param unknown $path : Route URI
     * @param unknown $callable : Callback, can also be a string Example : Foo#bar, FooController and bar method
     * @param unknown $name : optional route name
     */
    public function post($path, $callable, $name=null){
        return $this->add($path, $callable, $name, 'POST');
    }
    /**
     * @param unknown $path : Route URI
     * @param unknown $callable : Callback, can also be a string Example : Foo#bar, FooController and bar method
     * @param unknown $name : optional route name
     */
    public function put($path, $callable, $name=null){
        return $this->add($path, $callable, $name, 'PUT');
    }
    /**
     * @param unknown $path : Route URI
     * @param unknown $callable : Callback, can also be a string Example : Foo#bar, FooController and bar method
     * @param unknown $name : optional route name
     */
    public function delete($path, $callable, $name=null){
        return $this->add($path, $callable, $name, 'DELETE');
    }
    /**
     * Add routes with closure objects
     * @param unknown $path
     * @param unknown $callable
     * @param unknown $name
     * @param unknown $method
     */
    private function add($path, $callable, $name, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name===null){
            $name = $callable;
        }
        if ($name){
            $this->namedRoutes[$name]= $route;
        }
        return $route;
    }
    /**
     * Perform URI treatment
     * @throws RouterException
     */
    public function run(){
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            // Catch this exception an answer a JSON
            throw new \Exception("REQUEST_METHOD does not exist");
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if ($route->match($this->url)){
                return $route->call();
            }
        }
        throw new \Exception("URL ".$this->url." does not exist! Did you forget to add it");
    }
    /**
     * Launch url call by name. Takes also parameters (optional)
     * @param unknown $name
     * @param array $options
     * @throws RouterException
     */
    public function url($name, $options=[]){
        if (!isset($this->namedRoutes[$name])){
            throw new \Exception('No route matches this name :'.$name);
        }
        return $this->namedRoutes[$name]->getUrl($options);
    }
}