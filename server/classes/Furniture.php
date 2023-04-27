<?php

require_once '../inc/dbh.inc.php';

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    public function __construct($conn, $sku, $productName, $price, $height, $width, $length)
    {
        $dimensions = $height . 'x' . $width . 'x' . $length;
        parent::__construct($conn, $sku, $productName, $price, 'furniture', $dimensions);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setLength($length) {
        $this->length = $length
        ;
    }

    public function getLength() {
        return $this->length;
    }

    public function getSpecificAttribute() {
        return $this->getHeight() . ' x ' . $this->getWidth() . ' x ' . $this->getLength();
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
            $height = htmlspecialchars(strip_tags($this->height));
            $width = htmlspecialchars(strip_tags($this->width));
            $length = htmlspecialchars(strip_tags($this->length));
            $productAttribute = json_encode(["height" => $height, "width" => $width, "length" => $length]);
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
        $query = "SELECT sku, productName, price, productAttribute FROM products WHERE productType='Furniture' ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $books = array();
        foreach ($results as $row) {
            $conn = $row['conn'];
            $sku = $row['sku'];
            $productName = $row['productName'];
            $price = $row['price'];
            $dimensions = explode('x', $row['productAttribute']);
            $height = $dimensions[0];
            $width = $dimensions[1];
            $length = $dimensions[2];
            $furniture = new Furniture($conn, $sku, $productName, $price, $height, $width, $length);
            $furnitureList[] = array(
                'sku' => $sku,
                'productName' => $productName,
                'price' => $price,
                'height' => $height,
                'width' => $width,
                'length' => $length
            );
        }
        $json = json_encode($furnitureList, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
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
