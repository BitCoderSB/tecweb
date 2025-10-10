<?php
$nombre   = 'nombre_producto';
$marca    = 'marca_producto';
$modelo   = 'modelo_producto';
$precio   = 1.0;
$detalles = 'detalles_producto';
$unidades = 1;
$imagen   = 'img/imagen.png';

@$link = new mysqli('localhost','root','', 'marketzone');
if ($link->connect_errno) { die('Falló la conexión: '.$link->connect_error); }
$link->set_charset('utf8mb4');

$sql = "INSERT INTO productos
        (nombre, marca, modelo, precio, unidades, detalles, imagen, eliminado)
        VALUES (?,?,?,?,?,?,?,0)";
$stmt = $link->prepare($sql);
$stmt->bind_param('sssdis s', $nombre,$marca,$modelo,$precio,$unidades,$detalles,$imagen); 


if ($stmt->execute()) {
    echo 'Producto insertado con ID: '.$stmt->insert_id;
} else {
    echo 'Error al insertar: '.$stmt->error;
}
$stmt->close();
$link->close();
