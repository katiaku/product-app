<?php

Route::get('/', [ProductsController::class, 'list']);
Route::post('/' , [ProductsController::class, 'delete']);
Route::post('/product-add' , [ProductsController::class, 'add']);
