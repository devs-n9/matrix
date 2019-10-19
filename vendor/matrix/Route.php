<?php

namespace Matrix;

use Matrix\Request;

class Route
{
    private static $controller = 'index';
    private static $action = 'index';
    private static $url = '';
    private static $rule = [];
    private static $params = [];

    public static function run()
    {

        if (empty(self::$rule)) {
            $params = explode('/',self::$url); // ['', 'news', 'list']
            
            array_shift($params);
            
            self::$rule = $params;

            if (!empty(self::$rule[0])) {
                self::$rule[0] = ucfirst(self::$controller) . 'Controller';
            }
            // var_dump('without routes');
        }

        // var_dump(self::$rule);
        
        if (!empty(self::$rule[0])) {
            self::$controller = self::$rule[0]; // news
        }

        if (!empty(self::$rule[1])) {
            self::$action = self::$rule[1]; // list
        }

        $controllerPath = APP . 'Controllers/' . self::$controller . '.php';

        if(file_exists($controllerPath)){
            $controller = 'App\\Controllers\\' . self::$controller;
            $controllerObj = new $controller;

            if(method_exists($controllerObj, self::$action)){
                // var_dump(self::$params);
                if(!empty(self::$params)){
                    call_user_func_array([$controllerObj, self::$action], self::$params);
                }else{
                    $action = self::$action;
                    $controllerObj->$action();
                }
                
            }else{
                echo 'Page 404 Not Found';
            }


        }else{
            echo 'Page 404 Not Found';
        }
    }

    public static function init()
    {
        self::$url = filter_input(INPUT_SERVER, 'REQUEST_URI');

        require APP . '/Routes.php';
    }

    public static function get($url, $rule)
    {
        self::setMethod($url, $rule, 'GET');
    }
    
    public static function post($url, $rule)
    {
        self::setMethod($url, $rule, 'POST');
    }

    public static function setMethod($url, $rule, $method)
    {
        $request = new Request();
        $ruleParts = explode('@', $rule);
        
        $params = self::getRoutesParams($url);
        
        if(!empty($url) && ($url == self::$url || $params) && $request->getMethod() == $method){
            self::$params = $params;
            self::$rule = $ruleParts;
        }
    }

    public static function getRoutesParams($url)
    {
        $uriParams = explode('/', self::$url);
        $urlParams = explode('/', $url);
        
        array_shift($uriParams);
        array_shift($urlParams);
        
        $params = [];
        $equal = true;
        
        foreach($urlParams as $k => $v) {
            preg_match_all("/\{(.*?)\}/", $v, $match);
            $isParam = (!empty($match[1]))?true : false;
            
            if(!empty($uriParams[$k]) && $isParam){
                $params[$match[1][0]] = $uriParams[$k];
            }elseif(empty($uriParams[$k]) || $uriParams[$k] != $v){
                $equal = false;
            }
        }

        return ($equal)?$params:false;
    }


}