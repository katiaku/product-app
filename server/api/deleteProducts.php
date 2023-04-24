<?php
require_once('cors.php');

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
