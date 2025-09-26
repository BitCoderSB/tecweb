<?php
$sexo = $_POST['sexo'] ?? '';
$edad = isset($_POST['edad']) ? intval($_POST['edad']) : null;

if ($sexo === 'femenino' && $edad !== null && $edad >= 18 && $edad <= 35) {
    $mensaje = "Bienvenida, usted está en el rango de edad permitido.";
} else {
    $mensaje = "Lo sentimos, no cumple con los requisitos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EJ5 - Respuesta</title>
</head>
<body>
    <h1>EJ5 - Respuesta</h1>
    <p><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
    <p><a href="ej5.php">Volver al formulario</a></p>
</body>
</html>