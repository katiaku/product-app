<?php

include '../inc/dbh.inc.php';

class Book extends Product
{
    public $weight;

    public function __construct($conn)
    {
        parent::__construct($conn);
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getProductTypeSpecificAttribute()
    {
        return $this->weight;
    }

    public function insertTypeSpecificAttribute($conn, $id)
    {
        $stmt = $conn->prepare("UPDATE products SET productAttribute = ? WHERE id = ?");
        $productAttribute = $this->getProductTypeSpecificAttribute();
        $stmt->bind_param("si", $productAttribute, $id);
        $stmt->execute();
    }
}
