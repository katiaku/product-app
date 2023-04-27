<?php

require_once 'cors.php';
require_once '../inc/dbh.inc.php';

include '../classes/Book.php';
include '../classes/DVD.php';
include '../classes/Furniture.php';

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
