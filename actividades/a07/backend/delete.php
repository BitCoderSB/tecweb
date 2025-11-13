<?php
use MyAPI\Products;
require_once 'myapi/Products.php';

$obj = new Products('tienda');
$obj->delete($_GET['id']);
echo $obj->getData();
