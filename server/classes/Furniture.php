<?php
include '../inc/dbh.inc.php';

class Furniture extends Product
{
    public $height;
    public $width;
    public $length;

    public function __construct($conn)
    {
        parent::__construct($conn);
    }

    public function setDimensions($height, $width, $length)
    {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getProductTypeSpecificAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function insertTypeSpecificAttributes($conn, $id)
    {
        $stmt = $conn->prepare("UPDATE products SET productAttribute = ? WHERE id = ?");
        $productAttribute = $this->getProductTypeSpecificAttribute();
        $stmt->bind_param("si", $productAttribute, $id);
        $stmt->execute();
    }
}
