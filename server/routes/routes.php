<?php

require_once '../http/cors.php';
require_once '../http/route.php';
require_once '../controllers/productController.php';
require_once './server/database/database.php';

Route::get('/', [ProductsController::class, 'list']);
Route::post('/' , [ProductsController::class, 'delete']);
Route::post('/product-add' , [ProductsController::class, 'add']);
