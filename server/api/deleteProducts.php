<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if($_POST) {
    include '../inc/dbh.inc.php';
    include '../classes/Product.php';
    include '../classes/Book.php';
    include '../classes/DVD.php';
    include '../classes/Furniture.php';

    $product = new Product ($conn);
    $ids = implode(",", $_POST['del_ids']);
    echo $product->delete($ids) ? "true" : "false";
}
