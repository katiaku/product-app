<?php

require_once './cors.php';

class Request
{    
    public function method() {
        return strtolower($_SERVER['REQUEST_METHOD']);    
    }
    public function path() {
        return explode("?", $_SERVER['REQUEST_URI'])[0];    
    }
    public static function body() {
        $json = file_get_contents('php://input');
        return  json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
    }
}
