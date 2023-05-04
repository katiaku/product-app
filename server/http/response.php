<?php

require_once './cors.php';

class Response
{
    protected $statusCode;
    protected $data;

    public function __construct($statusCode = null, $data = "Error") {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public function sendResponse() {
        http_response_code($this->statusCode);
        echo json_encode($this->data);
    }
}
