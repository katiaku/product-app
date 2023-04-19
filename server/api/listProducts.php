<?php
header('Access-Control-Allow-Origin: http://localhost:3000');

include '../inc/dbh.inc.php';
include '../classes/Product.php';
include '../classes/Book.php';
include '../classes/DVD.php';
include '../classes/Furniture.php';

$product = new Product($conn);
$results = $product->list();
echo $results;
