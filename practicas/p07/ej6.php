<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EJ6 - Consulta de autos</title>
</head>
<body>
    <h1>EJ6 - Consulta de autos</h1>
    <form method="POST" action="ej6_respuesta.php">
        <label>Matrícula: <input type="text" name="matricula" placeholder="ABC1234" pattern="[A-Za-z]{3}[0-9]{4}"></label>
        <br><br>
        <label><input type="checkbox" name="todos" value="1"> Ver todos</label>
        <br><br>
        <button type="submit">Consultar</button>
    </form>
</body>
</html>