<?php
require_once '../inc/dbh.inc.php';

abstract class Product
{
    protected $conn;
    protected $tableName = "products";

    protected $sku;
    protected $productName;
    protected $price;
    protected $productType;

    public function __construct($conn)
    {
        $this->conn =$conn;
    }

    public function getSku() {
        return $this->sku;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getProductType() {
        return $this->productType;
    }

    public function setProductType($productType) {
        $this->productType = $productType;
    }

    abstract public function getProductAttribute();

    public function add()
    {
        try {
            $query = "INSERT INTO products SET sku=?, productName=?, price=?, productType=?";
            $stmt = $this->conn->prepare($query);
            $sku = htmlspecialchars(strip_tags($this->sku));
            $productName = htmlspecialchars(strip_tags($this->productName));
            $price = htmlspecialchars(strip_tags($this->price));
            $productType = htmlspecialchars(strip_tags($this->productType));
            $stmt->bind_param('ssds', $sku, $productName, $price, $productType);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(mysqli_sql_exception $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

    public function insertProductAttribute($conn, $id)
    {
        $stmt = $conn->prepare("UPDATE products SET productAttribute = ? WHERE id = ?");
        $productAttribute = $this->getProductAttribute();
        $stmt->bind_param("si", $productAttribute, $id);
        $stmt->execute();
    }

    public function list()
    {
        $query = "SELECT sku, productName, price, productAttribute FROM " . $this->tableName . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($results as &$row) {
            $row['productAttribute'] = json_decode($row['productAttribute'], true);
        }
        $json = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
        return $json;
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
