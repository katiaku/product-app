<?php

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DB = "product-app-scandiweb";

$conn = new mysqli(HOST, USERNAME, PASSWORD, DB);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
