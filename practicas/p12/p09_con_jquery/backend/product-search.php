<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/database.php';

$q = $_GET['search'] ?? '';

try {
    $sql = "SELECT * FROM productos WHERE eliminado=0 
            AND (nombre LIKE :q OR marca LIKE :q OR modelo LIKE :q)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['q' => "%$q%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
} catch (Throwable $e) {
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}
