<?php

require_once '../models/Product.php';

class DVD extends Product
{
    protected $size;

    public function setValues($product) {
        parent::setValues($product);
        $this->size = $product['size'];
        return true;
    }

    public function add(): bool{
        $conn = Database::connect();
        try {
            $sku_query = "SELECT * FROM products WHERE sku = '{$this->sku}'";
            $sku_result = $conn->query($sku_query);
            if ($sku_result->num_rows > 0) {
                throw new Exception('SKU already exists');
            }
            $insert_query = "INSERT INTO products VALUES ('{$this->sku}', '{$this->name}', {$this->price}, '{$this->type}', '{$this->size}')";
            $result = $conn->query($insert_query);
            if (!$result) {
                throw new Exception('Failed to insert product');
            }
            return true;
        } catch(Exception $e) {
            return false;
        } finally {
            Database::disconnect();
        }
    }
}
