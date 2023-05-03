<?php

require_once '../database/dbh.inc.php';

abstract class Product
{
    protected $conn;
    protected $tableName = 'products';
    protected $sku;
    protected $productName;
    protected $price;
    protected $productType;
    protected $productAttribute;

    public function __construct($conn, $sku, $productName, $price, $productType, $productAttribute)
    {
        $this->conn = $conn;
        $this->sku = $sku;
        $this->productName = $productName;
        $this->price = $price;
        $this->productType = $productType;
        $this->productAttribute = $productAttribute;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function getSku() {
        return $this->sku;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setProductType($productType) {
        $this->productType = $productType;
    }

    public function getProductType() {
        return $this->productType;
    }

    public function setProductAttribute($productAttribute) {
        $this->productAttribute = $productAttribute;
    }

    public function getProductAttribute() {
        return $this->productAttribute;
    }

    abstract public function getSpecificAttribute();

    abstract public function add();

    abstract public function list();

    abstract public function delete($ids);
}
