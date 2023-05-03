<?php

require_once 'cors.php';

if($_POST) {
    require_once '../database/dbh.inc.php';
    require_once '../models/Product.php';
    require_once '../models/Book.php';
    require_once '../models/DVD.php';
    require_once '../models/Furniture.php';

    if (isset($_POST['del_ids'])) {
        $ids = implode(",", $_POST['del_ids']);
        $book = new Book($conn, null, null, null, null, null);
        $dvd = new DVD($conn, null, null, null, null, null);
        $furniture = new Furniture($conn, null, null, null, null, null, null, null);
        $success = $book->delete($ids) && $dvd->delete($ids) && $furniture->delete($ids);
        echo $success ? "true" : "false";
    }
}
