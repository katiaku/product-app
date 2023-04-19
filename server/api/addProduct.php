<?php
header('Access-Control-Allow-Origin: http://localhost:3000');

if($_POST) {
    include '../inc/dbh.inc.php';
    include '../classes/Product.php';
    include '../classes/Book.php';
    include '../classes/DVD.php';
    include '../classes/Furniture.php';

    $product = new Product ($conn);
    $product->sku = $_POST['sku'];
    $product->productName = $_POST['productName'];
    $product->price = $_POST['price'];
    $product->productType = $_POST['productType'];
    $product->productAttribute = $_POST['productAttribute'];
    echo $product->add() ? "true" : "false";
}
