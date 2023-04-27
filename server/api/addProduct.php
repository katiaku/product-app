<?php

require_once 'cors.php';

if($_POST) {
    require_once '../inc/dbh.inc.php';
    include '../classes/Book.php';
    include '../classes/DVD.php';
    include '../classes/Furniture.php';

    $sku = $_POST['sku'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $productType = $_POST['productType'];
    $productAttribute = $_POST['productAttribute'];

    $book = new Book($conn, $sku, $productName, $price, $productAttribute);
    $dvd = new DVD($conn, $sku, $productName, $price, $productAttribute);
    $furniture = new Furniture($conn, $sku, $productName, $price, $productAttribute);

    if ($productType === 'Book') {
        $book->setProductType($productType);
        $book->setProductAttribute('weight', $productAttribute);
        if ($book->add()) {
            echo "true";
        } else {
            echo "false";
        }
    } elseif ($productType === 'DVD') {
        $dvd->setProductType($productType);
        $dvd->setProductAttribute('size', $productAttribute);
        if ($dvd->add()) {
            echo "true";
        } else {
            echo "false";
        }
    } elseif ($productType === 'Furniture') {
        $dimensions = explode('x', $productAttribute);
        $height = $dimensions[0];
        $width = $dimensions[1];
        $length = $dimensions[2];
        $furniture->setProductType($productType);
        $furniture->setProductAttribute('height', $height);
        $furniture->setProductAttribute('width', $width);
        $furniture->setProductAttribute('length', $length);
        if ($furniture->add()) {
            echo "true";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
}
