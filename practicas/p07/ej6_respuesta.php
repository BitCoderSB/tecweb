<?php
$autos = [
    "UBN6338"=>["Auto"=>["marca"=>"Nissan","modelo"=>"2018","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Aldo","ciudad"=>"Puebla","direccion"=>"Calle 1"]],
    "ABC1234"=>["Auto"=>["marca"=>"Toyota","modelo"=>"2019","tipo"=>"SUV"],"Propietario"=>["nombre"=>"Ana","ciudad"=>"CDMX","direccion"=>"Calle 2"]],
    "XYZ5678"=>["Auto"=>["marca"=>"Honda","modelo"=>"2020","tipo"=>"Hatchback"],"Propietario"=>["nombre"=>"Luis","ciudad"=>"Guadalajara","direccion"=>"Calle 3"]],
    "JKL4321"=>["Auto"=>["marca"=>"Mazda","modelo"=>"2017","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Karla","ciudad"=>"Monterrey","direccion"=>"Calle 4"]],
    "QWE9988"=>["Auto"=>["marca"=>"Ford","modelo"=>"2016","tipo"=>"Pick-up"],"Propietario"=>["nombre"=>"Bruno","ciudad"=>"Querétaro","direccion"=>"Calle 5"]],
    "RTY7766"=>["Auto"=>["marca"=>"Volkswagen","modelo"=>"2015","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Rosa","ciudad"=>"Mérida","direccion"=>"Calle 6"]],
    "ASD5544"=>["Auto"=>["marca"=>"Chevrolet","modelo"=>"2014","tipo"=>"SUV"],"Propietario"=>["nombre"=>"Diego","ciudad"=>"Toluca","direccion"=>"Calle 7"]],
    "FGH2211"=>["Auto"=>["marca"=>"Kia","modelo"=>"2021","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Lia","ciudad"=>"Tijuana","direccion"=>"Calle 8"]],
    "ZXC1100"=>["Auto"=>["marca"=>"Hyundai","modelo"=>"2018","tipo"=>"SUV"],"Propietario"=>["nombre"=>"Mario","ciudad"=>"León","direccion"=>"Calle 9"]],
    "PLM7788"=>["Auto"=>["marca"=>"Peugeot","modelo"=>"2013","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Sara","ciudad"=>"Pachuca","direccion"=>"Calle 10"]],
    "BNM6677"=>["Auto"=>["marca"=>"Renault","modelo"=>"2019","tipo"=>"Hatchback"],"Propietario"=>["nombre"=>"Raúl","ciudad"=>"Veracruz","direccion"=>"Calle 11"]],
    "HJK8899"=>["Auto"=>["marca"=>"Seat","modelo"=>"2018","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Eva","ciudad"=>"Aguascalientes","direccion"=>"Calle 12"]],
    "VBN3355"=>["Auto"=>["marca"=>"Audi","modelo"=>"2017","tipo"=>"Sedán"],"Propietario"=>["nombre"=>"Pablo","ciudad"=>"Zacatecas","direccion"=>"Calle 13"]],
    "MNB2244"=>["Auto"=>["marca"=>"BMW","modelo"=>"2020","tipo"=>"Coupé"],"Propietario"=>["nombre"=>"Inés","ciudad"=>"Morelia","direccion"=>"Calle 14"]],
    "TYU4433"=>["Auto"=>["marca"=>"Mercedes","modelo"=>"2022","tipo"=>"SUV"],"Propietario"=>["nombre"=>"Noel","ciudad"=>"Cuernavaca","direccion"=>"Calle 15"]],
];

// Procesar solicitud
if (!empty($_POST['todos'])) {
    $resultado = $autos;
    $modo = "todos";
} elseif (!empty($_POST['matricula'])) {
    $mat = strtoupper(trim($_POST['matricula']));
    $resultado = $autos[$mat] ?? null;
    $modo = "matricula";
} else {
    $resultado = null;
    $modo = "ninguno";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EJ6 - Respuesta</title>
    <style>table{border-collapse:collapse}td,th{border:1px solid #333;padding:4px}</style>
</head>
<body>
    <h1>EJ6 - Respuesta</h1>

    <?php if ($modo === "todos" && is_array($resultado)): ?>
        <h2>Listado completo (<?= count($resultado) ?>)</h2>
        <table>
            <thead><tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th>Tipo</th><th>Propietario</th><th>Ciudad</th><th>Dirección</th></tr></thead>
            <tbody>
                <?php foreach ($resultado as $placa=>$info): ?>
                    <tr>
                        <td><?= htmlspecialchars($placa) ?></td>
                        <td><?= htmlspecialchars($info["Auto"]["marca"]) ?></td>
                        <td><?= htmlspecialchars($info["Auto"]["modelo"]) ?></td>
                        <td><?= htmlspecialchars($info["Auto"]["tipo"]) ?></td>
                        <td><?= htmlspecialchars($info["Propietario"]["nombre"]) ?></td>
                        <td><?= htmlspecialchars($info["Propietario"]["ciudad"]) ?></td>
                        <td><?= htmlspecialchars($info["Propietario"]["direccion"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Estructura (print_r)</h3>
        <pre><?php print_r($resultado); ?></pre>

    <?php elseif ($modo === "matricula"): ?>
        <?php if ($resultado): ?>
            <h2>Consulta por matrícula</h2>
            <table>
                <thead><tr><th>Campo</th><th>Valor</th></tr></thead>
                <tbody>
                    <tr><td>Matrícula</td><td><?= htmlspecialchars($mat) ?></td></tr>
                    <tr><td>Marca</td><td><?= htmlspecialchars($resultado["Auto"]["marca"]) ?></td></tr>
                    <tr><td>Modelo</td><td><?= htmlspecialchars($resultado["Auto"]["modelo"]) ?></td></tr>
                    <tr><td>Tipo</td><td><?= htmlspecialchars($resultado["Auto"]["tipo"]) ?></td></tr>
                    <tr><td>Propietario</td><td><?= htmlspecialchars($resultado["Propietario"]["nombre"]) ?></td></tr>
                    <tr><td>Ciudad</td><td><?= htmlspecialchars($resultado["Propietario"]["ciudad"]) ?></td></tr>
                    <tr><td>Dirección</td><td><?= htmlspecialchars($resultado["Propietario"]["direccion"]) ?></td></tr>
                </tbody>
            </table>
            <h3>Estructura (print_r)</h3>
            <pre><?php print_r($resultado); ?></pre>
        <?php else: ?>
            <p>No se encontró la matrícula solicitada.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>No se envió ninguna solicitud. Vuelve al <a href="ej6.php">formulario</a>.</p>
    <?php endif; ?>

    <p><a href="ej6.php">Volver al formulario</a></p>
</body>
</html>