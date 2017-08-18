<?php
namespace Src\Api\Router;
/**
 * V�rification des routes
 * @author yacmed
 *
 */
class Route {
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];
    public function __construct($path, $callable){
        $path =  trim($path,'/');
        $this->path = $path;
        $this->callable = $callable;
    }
    /**
     * Return true if url matches, false else
     * @param unknown $url
     */
    public function match($url){
        $url = trim($url,'/');
        $path = preg_replace_callback('#:([\w]+)#', [$this,'paramMatch'],$this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $this->matches)){
            return false;
        }
        array_shift($this->matches);
        return true;
    }
    private function paramMatch($match){
        if (isset($this->params[$match[1]])){
            return '('.$this->params[$match[1]].')';
        }
        return '([^/]+)';
    }
    /**
     * Call a callback, for url matches. Usefull for calling Controllers for a URI
     */
    public function call(){
        if (is_string($this->callable)){
            $params = explode('#', $this->callable);
            $rootNameSpace = explode('\\',__NAMESPACE__);
            $rootNameSpace = $rootNameSpace[0];
            $controller = $rootNameSpace."\\Api\\Controllers\\".$params[0]."Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]],$this->matches);
        } else {
            return call_user_func_array($this->callable,$this->matches);
        }
    }
    /**
     * Function used for url params validation
     * @param $param
     * @param $regex
     * @return $this
     */
    public function with($param, $regex){
        $this->params[$param]=str_replace('(', '(?:', $regex);
        return $this;
    }
    public function getUrl($options){
        $path = $this->path;
        foreach ($options as $k=>$v){
            $path= str_replace(':'.$k, $v, $path);
        }
        return $path;
    }
    public function isApi($uri) {
        if (!preg_match("api", $uri)){
            return false;
        }
        return true;
    }
}