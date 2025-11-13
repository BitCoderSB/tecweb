<?php
use MyAPI\Products;
require_once 'myapi/Products.php';

$obj = new Products('tienda');
$obj->getAll();
echo $obj->getData();
