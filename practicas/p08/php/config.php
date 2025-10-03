<?php
$DB_HOST = '127.0.0.1';
$DB_PORT = 3306;        // (si lo cambiaste: 3307)
$DB_USER = 'root';      // por defecto XAMPP
$DB_PASS = '';          // vacío por defecto
$DB_NAME = 'marketzone';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

if ($mysqli->connect_errno) {
    die('Error de conexión: '.$mysqli->connect_error);
}

$mysqli->set_charset('utf8');
?>