<?php
require_once('cors.php');

include '../inc/dbh.inc.php';
include '../classes/Product.php';
include '../classes/Book.php';
include '../classes/DVD.php';
include '../classes/Furniture.php';

$product = new Product($conn);
$results = $product->list();
echo $results;
