<?php
header('Access-Control-Allow-Origin: http://localhost:3000');

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
