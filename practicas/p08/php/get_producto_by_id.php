<?php
require __DIR__.'/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Preparar y ejecutar la consulta
$stmt = $mysqli->prepare("SELECT * FROM productos WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

header('Content-Type:text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Producto por ID</title>
</head>
<body>
    <h1>Producto por ID</h1>

    <?php if ($row): ?>
        <ul>
            <li>ID: <?= $row['id'] ?></li>
            <li>Nombre: <?= htmlspecialchars($row['nombre']) ?></li>
            <li>Marca: <?= htmlspecialchars($row['marca']) ?></li>
            <li>Modelo: <?= htmlspecialchars($row['modelo']) ?></li>
            <li>Precio: $<?= $row['precio'] ?></li>
            <li>Unidades: <?= $row['unidades'] ?></li>
            <li>Detalles: <?= htmlspecialchars($row['detalles']) ?></li>
        </ul>
    <?php else: ?>
        <p>No existe producto con ese ID</p>
    <?php endif; ?>
</body>
</html>
<?php
$stmt->close();
$mysqli->close();
?>