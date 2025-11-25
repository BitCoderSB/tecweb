<?php
// Usar la conexión PDO estilo prácticas anteriores
require_once __DIR__ . '/../backend/database.php';

$autoload = __DIR__ . '/../vendor/autoload.php';
$autoloadMissing = false;
if (file_exists($autoload)) {
  require $autoload;
} else {
  // Fallback mínimo: cargar la clase Read directamente si no hay composer
  $autoloadMissing = true;
  require_once __DIR__ . '/../src/Read/ProductRead.php';
}

use P13\ProductApp\Read\ProductRead;

try {
  // $pdo viene de backend/database.php
  $reader = new ProductRead($pdo);
  $products = $reader->all();
} catch (\Throwable $e) {
  $products = [];
  $error = $e->getMessage();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Práctica 13 - Productos</title>
  <style>table{border-collapse:collapse}td,th{padding:6px;border:1px solid #ccc}</style>
</head>
<body>
  <h1>Productos (Práctica 13)</h1>
  <?php if (!empty($error)): ?>
    <div style="color:red">Error connecting to DB: <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Precio</th></tr>
    <?php foreach ($products as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= htmlspecialchars($p['marca']) ?></td>
        <td><?= htmlspecialchars($p['modelo']) ?></td>
        <td><?= htmlspecialchars($p['precio']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
