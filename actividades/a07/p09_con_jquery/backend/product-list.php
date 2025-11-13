<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM productos WHERE eliminado=0 ORDER BY id DESC");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
} catch (Throwable $e) {
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}
?>
