<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include '../inc/dbh.inc.php';
include '../classes/Product.php';

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
