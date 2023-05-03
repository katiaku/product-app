<?php

require_once 'cors.php';
require_once '../database/dbh.inc.php';

require_once '../models/Product.php';
require_once '../models/Book.php';
require_once '../models/DVD.php';
require_once '../models/Furniture.php';

$sku = $_GET['sku'];
$sql = "SELECT COUNT(*) as count FROM products WHERE sku = '$sku'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $count = $row["count"];
    echo json_encode(array("exists" => ($count > 0)));
} else {
    echo json_encode(array("error" => "Query failed."));
}
