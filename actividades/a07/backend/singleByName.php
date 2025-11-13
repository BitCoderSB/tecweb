<?php
use MyAPI\Products;
require_once 'myapi/Products.php';

$obj = new Products('tienda');
$obj->singleByName($_GET['nombre']);
echo $obj->getData();
