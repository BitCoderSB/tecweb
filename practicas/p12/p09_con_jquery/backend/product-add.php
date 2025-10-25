<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/database.php';

$body = json_decode(file_get_contents('php://input'), true);

if (!$body || !isset($body['nombre'])) {
    echo json_encode(['status' => false, 'message' => 'JSON inválido']);
    exit;
}

$nombre   = $body['nombre'];
$marca    = $body['marca'] ?? 'NA';
$modelo   = $body['modelo'] ?? 'NA';
$precio   = $body['precio'] ?? 0;
$unidades = $body['unidades'] ?? 0;
$detalles = $body['detalles'] ?? '';
$imagen   = $body['imagen'] ?? 'img/default.png';

// Validación: el precio no puede ser negativo
if ($precio < 0) {
    echo json_encode(['status' => false, 'message' => 'El precio no puede ser negativo']);
    exit;
}

try {
    if (!empty($body['id'])) {
        // UPDATE
        $id = (int)$body['id'];
        $sql = "UPDATE productos 
                SET nombre=?, marca=?, modelo=?, precio=?, unidades=?, detalles=?, imagen=? 
                WHERE id=? AND eliminado=0";
        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([$nombre, $marca, $modelo, $precio, $unidades, $detalles, $imagen, $id]);
        echo json_encode(['status' => $ok, 'message' => $ok ? 'Actualizado' : 'No se actualizó']);
    } else {
        // INSERT
        $sql = "INSERT INTO productos(nombre, marca, modelo, precio, unidades, detalles, imagen, eliminado) 
                VALUES(?,?,?,?,?,?,?,0)";
        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([$nombre, $marca, $modelo, $precio, $unidades, $detalles, $imagen]);
        echo json_encode(['status' => $ok, 'message' => $ok ? 'Insertado' : 'No se insertó']);
    }
} catch (Throwable $e) {
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}
?>
