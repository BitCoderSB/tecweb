<?php
$host = "localhost";
$user = "root";         // tu usuario de MySQL
$password = "";         // tu contraseña de MySQL, en XAMPP normalmente está vacío
$dbname = "marketzone"; // usa el nombre real de tu base de datos

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Error de conexión: " . $conn->connect_error
    ]));
}

mysqli_set_charset($conn, "utf8");
?>
