<?php

require_once '../http/cors.php';
require_once '../http/route.php';
require_once '../controllers/productController.php';
require_once './server/database/database.php';

Route::get('/', [ProductController::class, 'list']);
Route::post('/' , [ProductController::class, 'delete']);
Route::post('/product-add' , [ProductController::class, 'add']);
