<?php

if (isset($_SERVER['HTTP_ORIGIN']) 
&& $_SERVER['HTTP_ORIGIN'] === '*') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, DELETE');
    header('Access-Control-Allow-Headers: *');
    exit(0);
}
