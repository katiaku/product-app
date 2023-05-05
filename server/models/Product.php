<?php

require_once '../database/database.php';

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected  $type;

    protected function setValues($product){
        $this->sku = $product['sku'];
        $this->name = $product['name'];
        $this->price = $product['price'];
        $this->type = $product['type'];
    }

    public abstract function add(): bool;

    public static function list() {
        $conn = Database::connect();
        try {
            $sql = "SELECT * FROM products";
            $result =  $conn->query($sql);   
            $products = []; 
            foreach($result as $row)
                $products[] = $row;
            return $products;
        } catch(Exception $e) {
            return $e;
        } finally {
            Database::disconnect();
        }  
    }

    public static function delete($products): bool {
        $conn = Database::connect();
        try{
            $conn->autocommit(FALSE);
            foreach($products as $product) {
                $conn->query("DELETE FROM products WHERE sku = '{$product['sku']}'");
            }
            if (!$conn->commit()) 
                return false;
        return true;
        } catch(Exception $e) {
            return false;
        } finally {
            Database::disconnect();
        }
    }
}
