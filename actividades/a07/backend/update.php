<?php
use MyAPI\Products;
require_once 'myapi/Products.php';

$body = file_get_contents("php://input");
$data = json_decode($body, true);

if (!$data || !isset($data['id'], $data['nombre'], $data['marca'], $data['modelo'], $data['precio'], $data['detalles'], $data['unidades'], $data['imagen'])) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos para actualizar']);
    exit;
}

$obj = new Products('tienda');
$obj->update(
    $data['id'],
    $data['nombre'],
    $data['marca'],
    $data['modelo'],
    $data['precio'],
    $data['detalles'],
    $data['unidades'],
    $data['imagen']
);

echo json_encode(['status' => 'ok', 'message' => 'Producto actualizado correctamente']);
