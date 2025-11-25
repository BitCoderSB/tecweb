<?php
// Test CLI script using backend/database.php PDO connection
require_once __DIR__ . '/backend/database.php';

$autoload = __DIR__ . '/vendor/autoload.php';
$autoloadMissing = false;
if (file_exists($autoload)) {
    require $autoload;
} else {
    // Fallback: cargar clases necesarias directamente si no hay composer
    $autoloadMissing = true;
    require_once __DIR__ . '/src/Create/ProductCreate.php';
    require_once __DIR__ . '/src/Read/ProductRead.php';
}

use P13\ProductApp\Create\ProductCreate;
use P13\ProductApp\Read\ProductRead;

// php test.php

try {
    // $pdo viene de backend/database.php
    $creator = new ProductCreate($pdo);
    $reader = new ProductRead($pdo);

    // create a sample product
    $id = $creator->create([
        'nombre' => 'Producto desde test',
        'marca' => 'Test',
        'modelo' => 'T-1',
        'precio' => 9.99,
        'detalles' => 'Insertado por test.php',
        'unidades' => 1,
        'imagen' => 'img/default.png',
    ]);

    echo "Inserted product id: $id\n";

    $all = $reader->all();
    echo "Total productos: " . count($all) . "\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

if ($autoloadMissing) {
    echo "Aviso: falta vendor/autoload.php — instala dependencias con Composer para usar autoload PSR-4.\n";
}
