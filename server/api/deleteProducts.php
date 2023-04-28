<?php

require_once 'cors.php';

if($_POST) {
    require_once '../inc/dbh.inc.php';
    include '../classes/Product.php';
    include '../classes/Book.php';
    include '../classes/DVD.php';
    include '../classes/Furniture.php';

    if (isset($_POST['del_ids'])) {
        $ids = implode(",", $_POST['del_ids']);
        $book = new Book($conn, null, null, null, null, null);
        $dvd = new DVD($conn, null, null, null, null, null);
        $furniture = new Furniture($conn, null, null, null, null, null, null, null);
        $success = $book->delete($ids) && $dvd->delete($ids) && $furniture->delete($ids);
        echo $success ? "true" : "false";
    }
}
