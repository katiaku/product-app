<?php

require_once '../inc/dbh.inc.php';
require_once '../classes/Product.php';

class Book extends Product
{
    protected $weight;

    public function __construct($conn, $sku, $productName, $price, $weight)
    {
        parent::__construct($conn, $sku, $productName, $price, 'book', ['weight' => $weight]);
        $this->weight = $weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getSpecificAttribute()
    {
        return $this->getWeight();
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
            $weight = htmlspecialchars(strip_tags($this->weight));
            $productAttribute = json_encode(["weight" => $weight]);
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
        $query = "SELECT sku, productName, price, productAttribute FROM products WHERE productType='Book' ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $books = array();
        foreach ($results as $row) {
            $conn = $row['conn'];
            $sku = $row['sku'];
            $productName = $row['productName'];
            $price = $row['price'];
            $weight = json_decode($row['productAttribute'], true)['weight'];
            $book = new Book($conn, $sku, $productName, $price, $weight);
            $books[] = array(
                'sku' => $sku,
                'productName' => $productName,
                'price' => $price,
                'weight' => $weight
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
