<?php

require_once 'cors.php';

if($_POST) {
    require_once '../database/dbh.inc.php';
    require_once '../models/Product.php';
    require_once '../models/Book.php';
    require_once '../models/DVD.php';
    require_once '../models/Furniture.php';

    $sku = $_POST['sku'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $productType = $_POST['productType'];
    $productAttribute = $_POST['productAttribute'];

    $book = new Book($conn, $sku, $productName, $price, $weight);
    $dvd = new DVD($conn, $sku, $productName, $price, $size);
    $furniture = new Furniture($conn, $sku, $productName, $price, $height, $width, $length);

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
