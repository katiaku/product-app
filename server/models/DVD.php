<?php

require_once '../database/dbh.inc.php';
require_once '../models/Product.php';

class DVD extends Product
{
    protected $size;

    public function __construct($conn, $sku, $productName, $price, $size)
    {
        parent::__construct($conn, $sku, $productName, $price, 'dvd', ['size' => $size]);
        $this->size = $size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function getSpecificAttribute() {
        return $this->getSize();
    }

    public function add()
    {
        try {
            $query = "INSERT INTO products SET sku=?, productName=?, price=?, productType=?, productAttribute=?";
            $stmt = $this->conn->prepare($query);
            $sku = htmlspecialchars(strip_tags($this->sku));
            $productName = htmlspecialchars(strip_tags($this->productName));
            $price = htmlspecialchars(strip_tags($this->price));
            $productType = htmlspecialchars(strip_tags($this->productType));
            $size = htmlspecialchars(strip_tags($this->size));
            $productAttribute = json_encode(["size" => $size]);
            $stmt->bind_param('ssdss', $sku, $productName, $price, $productType, $productAttribute);

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
        $query = "SELECT sku, productName, price, productAttribute FROM products WHERE productType='DVD' ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $books = array();
        foreach ($results as $row) {
            $conn = $row['conn'];
            $sku = $row['sku'];
            $productName = $row['productName'];
            $price = $row['price'];
            $size = json_decode($row['productAttribute'], true)['size'];
            $dvd = new DVD($conn, $sku, $productName, $price, $size);
            $books[] = array(
                'sku' => $sku,
                'productName' => $productName,
                'price' => $price,
                'size' => $size
            );
    }
    $json = json_encode($books, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
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
