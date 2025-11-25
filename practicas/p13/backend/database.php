<?php
$host = "127.0.0.1";
$dbname = "marketzone"; // Cambia aquí si quieres usar otra BDD (ej. 'tienda')
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
    exit;
}

// Ahora puedes usar $pdo en tus scripts que incluyan este archivo.
// Ejemplo: require_once __DIR__ . '/backend/database.php';
