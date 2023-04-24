<?php
include '../inc/dbh.inc.php';

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    public function __construct($conn, $sku, $productName, $price, $productType, $height, $width, $length)
    {
        parent::__construct($conn);
        $this->sku = $sku;
        $this->productName = $productName;
        $this->price = $price;
        $this->productType = $productType;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

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

    public function getProductAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length;
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
