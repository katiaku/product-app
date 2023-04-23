<?php

include '../inc/dbh.inc.php';

class DVD extends Product
{
    public $size;

    public function __construct($conn)
    {
        parent::__construct($conn);
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getProductTypeSpecificAttribute()
    {
        return $this->size;
    }

    public function insertTypeSpecificAttributes($conn, $id)
    {
        $stmt = $conn->prepare("UPDATE products SET productAttribute = ? WHERE id = ?");
        $productAttribute = $this->getProductTypeSpecificAttribute();
        $stmt->bind_param("si", $productAttribute, $id);
        $stmt->execute();
    }
}
