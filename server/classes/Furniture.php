<?php
require_once '../inc/dbh.inc.php';

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    public function __construct($conn, $sku, $productName, $price, $productType, $height, $width, $length)
    {
        parent::__construct($conn);
        $this->setSku($sku);
        $this->setProductName($productName);
        $this->setPrice($price);
        $this->setProductType($productType);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function getProductAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length;
    }
}
