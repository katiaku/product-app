<?php
require_once '../inc/dbh.inc.php';

class DVD extends Product
{
    protected $size;

    public function __construct($conn, $sku, $productName, $price, $productType, $size)
    {
        parent::__construct($conn);
        $this->setSku($sku);
        $this->setProductName($productName);
        $this->setPrice($price);
        $this->setProductType($productType);
        $this->setSize($size);
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getProductAttribute()
    {
        return $this->size;
    }
}
