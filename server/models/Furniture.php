<?php

require_once '../models/Product.php';
require_once '../database/database.php';
require_once '../http/cors.php';

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;
    protected $dimensions;

    public function add(): bool{
        $conn = Database::connect();
        try {
            $sku_query = "SELECT * FROM products WHERE sku = '{$this->sku}'";
            $sku_result = $conn->query($sku_query);
            if ($sku_result->num_rows > 0) {
                throw new Exception('Provided SKU already exists');
            }
            $insert_query = "INSERT INTO products VALUES ('{$this->sku}', '{$this->name}', {$this->price}, '{$this->type}', '{$this->dimensions}')";
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

    public function setValues($product) {
        parent::setValues($product);
        $this->height = $product['height'];
        $this->width = $product['width'];
        $this->length = $product['length'];
        $this->dimensions = $this->height . 'x' . $this->length . 'x' . $this->width;
    }
}
