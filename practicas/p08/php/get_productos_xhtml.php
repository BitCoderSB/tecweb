<?php
require __DIR__.'/config.php';

$tope = isset($_GET['tope']) ? intval($_GET['tope']) : 0;

// Preparar y ejecutar la consulta
$stmt = $mysqli->prepare("SELECT * FROM productos WHERE unidades <= ? ORDER BY unidades ASC");
$stmt->bind_param("i", $tope);
$stmt->execute();
$res = $stmt->get_result();

header('Content-Type: application/xhtml+xml; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Productos XHTML</title>
</head>
<body>
    <h1>Productos con unidades menores o iguales a <?= htmlspecialchars($tope, ENT_QUOTES, 'UTF-8') ?></h1>

    <ul>
    <?php while ($row = $res->fetch_assoc()): ?>
        <li><?= htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') ?> - <?= $row['unidades'] ?> unidades</li>
    <?php endwhile; ?>
    </ul>
</body>
</html>
<?php
$stmt->close();
$mysqli->close();
?>