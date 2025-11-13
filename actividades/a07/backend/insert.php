<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

use MyAPI\Products;
require_once 'myapi/Products.php';

$body = file_get_contents("php://input");
$data = json_decode($body, true);

if (!$data || !isset(
    $data['nombre'],
    $data['marca'],
    $data['modelo'],
    $data['precio'],
    $data['detalles'],
    $data['unidades'],
    $data['imagen']
)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Datos incompletos o mal formateados'
    ]);
    exit;
}

try {
    $obj = new Products('tienda');
    $obj->insert(
        $data['nombre'],
        $data['marca'],
        $data['modelo'],
        $data['precio'],
        $data['detalles'],
        $data['unidades'],
        $data['imagen']
    );

    echo json_encode([
        'status' => 'ok',
        'message' => 'Producto insertado correctamente'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al insertar: ' . $e->getMessage()
    ]);
}
