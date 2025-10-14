<?php
$cn = new mysqli('localhost', 'root', '', 'tienda');
if ($cn->connect_error) {
    http_response_code(500);
    exit('Error DB');
}

$id = $_POST['id'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$precio = $_POST['precio'] ?? '';
$detalles = $_POST['detalles'] ?? '';
$unidades = $_POST['unidades'] ?? '';
$imagen = $_POST['imagen'] ?? 'cat.png';

if ($imagen === '') {
    $imagen = 'cat.png';
}

$stmt = $cn->prepare("UPDATE productos SET nombre=?,marca=?,modelo=?,precio=?,detalles=?,unidades=?,imagen=? WHERE id=?");
$stmt->bind_param('ssssssis', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
$ok = $stmt->execute();

if ($ok) {
    header('Location: get_productos_xhtml_v2.php?ok=1');
    exit;
}

http_response_code(500);
echo 'Error: ' . $stmt->error;
