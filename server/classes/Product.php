<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../inc/dbh.inc.php';

abstract class Product
{
    public $conn;
    public $tableName = "products";

    public $id;
    public $sku;
    public $productName;
    public $price;
    public $productType;
    public $productAttribute;

    public function __construct($conn)
    {
        $this->conn =$conn;
    }

    public function add()
    {
        try {
            $query = "INSERT INTO products SET sku=?, productName=?, price=?";
            $stmt = $this->conn->prepare($query);
            $sku = htmlspecialchars(strip_tags($this->sku));
            $productName = htmlspecialchars(strip_tags($this->productName));
            $price = htmlspecialchars(strip_tags($this->price));
            $stmt->bind_param('ssd', $sku, $productName, $price);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(mysqli_sql_exception $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

    public function list()
    {
        exit('hola');
        $query = "SELECT sku, productName, price, productType, productAttribute FROM " . $this->tableName . "ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return json_encode($results);
    }

    public function delete($ids)
    {
        $query = "DELETE FROM products WHERE id IN ($ids)";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
