<?php

require_once '../models/Book.php';
require_once '../models/DVD.php';
require_once '../models/Furniture.php';
require_once '../http/request.php';
require_once '../http/response.php';
require_once '../database/database.php';
require_once '../http/cors.php';

class ProductController
{
    protected $types;

    public function __construct() {
        $this->types = [
            'Book' =>  new Book() , 
            'DVD' => new DVD() ,
            'Furniture' => new Furniture()
        ];
    }

    public function add() {
        try {    
            $response = new Response();
            $product = Request::body();
            $typeName = $product['productType'];
            $createProduct = new $typeName();
            $createProduct->setValues($product);
            $created = $createProduct->create();  
            if ($created)
                $response = new Response(200, "Added successfully");
            else throw new Exception();
            $response->sendResponse();
        } catch(Exception $e) {
            $response = new Response(409, "Input error");
            $response->sendResponse();
        }
    }

    public function list() {
        try {
            $productList = Product::list();
            if (sizeof($productList))
                $response = new Response(200, $productList);
            else throw new Exception();
        } catch(Exception $e) {
            $response = new Response(502, "Error");
        } finally {
            $response->sendResponse();
        }
    }

    public function delete(){
        try{
            $response = null;
            $products = Request::body();
            $deleted = Product::delete($products);
            if ($deleted)
                $response = new Response(200, "Deleted successfully");
            else throw new Exception();
        } catch(Exception $e) {
            $response = new Response(502, "Error");
        } finally {
            $response->sendResponse();
        }
    }
}
