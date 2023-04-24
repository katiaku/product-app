<?php
include '../inc/dbh.inc.php';

abstract class Product
{
    protected $conn;
    protected $tableName = "products";

    protected $sku;
    protected $productName;
    protected $price;
    protected $productType;

    public function __construct($conn)
    {
        $this->conn =$conn;
    }

    abstract public function add();

    abstract public function list();

    abstract public function delete($ids);
}
