<?php
require_once '../inc/dbh.inc.php';

class Book extends Product
{
    protected $weight;

    public function __construct($conn, $sku, $productName, $price, $productType, $weight)
    {
        parent::__construct($conn);
        $this->setSku($sku);
        $this->setProductName($productName);
        $this->setPrice($price);
        $this->setProductType($productType);
        $this->setWeight($weight);
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getProductAttribute()
    {
        return $this->weight;
    }
}
