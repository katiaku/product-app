<?php

require_once './cors.php';
require_once './request.php';
require_once './response.php';

class Route
{
    public Request $request;
    public Response $response;
    public static array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get(string $route,  $action) {
        self::$routes['get'][$route] = $action;
    }
    
    public static function post(string $route ,$action) {
        self::$routes['post'][$route] = $action;
    }

    public static function delete(string $route ,  $action) {
        self::$routes['delete'][$route] = $action;
    }
        
    public function resolve() {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;
        if(!$action){
            http_response_code(404);    
            echo "Not Found";
            return;
        } 

        if(is_callable($action)) call_user_func($action);
        else if(is_array($action)) call_user_func_array([new $action[0], $action[1]] , []);
    }
}
