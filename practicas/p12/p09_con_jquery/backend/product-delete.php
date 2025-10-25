<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/database.php';

$id = $_GET['id'] ?? 0;

if (!$id) {
    echo json_encode(['status' => false, 'message' => 'ID requerido']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE productos SET eliminado=1 WHERE id=?");
    $ok = $stmt->execute([$id]);
    echo json_encode(['status' => $ok, 'message' => $ok ? 'Eliminado' : 'No se eliminó']);
} catch (Throwable $e) {
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}
?>
