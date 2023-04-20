<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../inc/dbh.inc.php';
include '../classes/Product.php';
include '../classes/Book.php';
include '../classes/DVD.php';
include '../classes/Furniture.php';

exit('test');
$product = new Product($conn);
$results = $product->list();
echo $results;
