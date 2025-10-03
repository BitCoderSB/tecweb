<?php
require __DIR__.'/config.php';

$tope = isset($_GET['tope']) ? floatval($_GET['tope']) : 0;

// Preparar y ejecutar la consulta
$stmt = $mysqli->prepare("SELECT * FROM productos WHERE precio <= ? ORDER BY precio ASC");
$stmt->bind_param("d", $tope);
$stmt->execute();
$res = $stmt->get_result();

header('Content-Type:text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Productos por precio</title>
</head>
<body>
    <h1>Productos con precio menor o igual a <?= htmlspecialchars($tope) ?></h1>

    <ul>
    <?php while ($row = $res->fetch_assoc()): ?>
        <li><?= $row['nombre'] ?> - $<?= $row['precio'] ?></li>
    <?php endwhile; ?>
    </ul>
</body>
</html>
<?php
$stmt->close();
$mysqli->close();
?>