<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include '../inc/dbh.inc.php';
include '../classes/Product.php';
include '../classes/Book.php';
include '../classes/DVD.php';
include '../classes/Furniture.php';

exit('test');
$product = new Product($conn);
$results = $product->list();
echo $results;
