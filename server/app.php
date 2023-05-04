<?php

class App
{
    protected Request $request;
    protected Response $response;
    protected Route $route;

    public function __construct(){
        $this->request = new Request();
        $this->response = new Response();
        $this->route =new Route($this->request, $this->response);
    }
    
    public function run(){
        Database::connect();
        $this->route->resolve();
    }
}
