<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EJ5 - Formulario</title>
</head>
<body>
    <h1>EJ5 - Formulario</h1>
    <form method="POST" action="ej5_respuesta.php">
        <label>Sexo:
            <select name="sexo">
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
            </select>
        </label>
        <br><br>
        <label>Edad: <input type="number" name="edad" min="0" required></label>
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>