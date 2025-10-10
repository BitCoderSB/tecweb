<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

$mysqli = new mysqli('localhost', 'root', '', 'marketzone');
if ($mysqli->connect_errno) {
    die('Error MySQL: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

$res = $mysqli->query("SELECT id, nombre, modelo, marca, precio, unidades, detalles, imagen
                       FROM productos 
                       WHERE eliminado = 0 
                       ORDER BY id DESC");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos vigentes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="formulario_productos.html">Nuevo</a>
            <a href="get_productos_vigentes.php">Vigentes</a>
        </div>

        <div class="card">
            <h1>Productos vigentes</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Detalles</th>
                    <th>Imagen</th>
                </tr>
                <?php while ($r = $res->fetch_assoc()): ?>
                    <tr>
                        <td><?= (int)$r['id'] ?></td>
                        <td><?= htmlspecialchars($r['nombre']) ?></td>
                        <td><?= htmlspecialchars($r['modelo']) ?></td>
                        <td><?= htmlspecialchars($r['marca']) ?></td>
                        <td><?= number_format((float)$r['precio'], 2) ?></td>
                        <td><?= (int)$r['unidades'] ?></td>
                        <td><?= htmlspecialchars($r['detalles']) ?></td>
                        <td>
                            <?php $src = htmlspecialchars($r['imagen'] ?: 'img/default.png'); ?>
                            <img class="thumb" src="<?= $src ?>" alt="">
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
