<?php

require_once 'cors.php';
require_once '../inc/dbh.inc.php';

require_once '../classes/Product.php';
require_once '../classes/Book.php';
require_once '../classes/DVD.php';
require_once '../classes/Furniture.php';

$book = new Book($conn, $sku, $productName, $price, $weight);
$dvd = new DVD($conn, $sku, $productName, $price, $size);
$furniture = new Furniture($conn, $sku, $productName, $price, $height, $width, $length);

$results = array_merge(
    json_decode($book->list(), true),
    json_decode($dvd->list(), true),
    json_decode($furniture->list(), true)
);

header('Content-Type: application/json');
echo json_encode($results);
