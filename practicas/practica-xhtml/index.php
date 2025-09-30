<?php
header('Content-Type: text/html; charset=UTF-8');

$alumno   = 'Tu Nombre';
$materia  = 'Desarrollo de Aplicaciones Web';
$grupo    = 'FCC-BUAP';
define('CAMPUS', 'BUAP');

$numero   = isset($_GET['numero']) ? intval($_GET['numero']) : 35;
$hoy      = date('Y-m-d H:i:s');
$pi       = pi();
$esPar    = ($numero % 2 === 0) ? 'sí' : 'no';

$tipos = array(
    'string'  => $alumno,
    'int'     => $numero,
    'float'   => $pi,
    'boolean' => ($numero > 0)
);

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>P05 &rarr; XHTML validado</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
</head>
<body>
    <div id="page">
        <h1>Práctica XHTML</h1>
        <p>Alumno: <?php echo e($alumno); ?><br />
            Materia: <?php echo e($materia); ?><br />
            Grupo: <?php echo e($grupo); ?><br />
            Campus: <?php echo e(CAMPUS); ?><br />
            Fecha/Hora: <?php echo e($hoy); ?></p>

        <h2>Ejemplo de variables</h2>
        <ul>
            <li>Numero: <?php echo e($numero); ?> (¿par?: <?php echo e($esPar); ?>)</li>
            <li>pi(): <?php echo number_format($pi, 5, '.', ''); ?></li>
            <li>Concatenación: <?php echo e($alumno . ' - ' . $materia); ?></li>
        </ul>

        <h3>Tabla de tipos</h3>
        <table summary="Tipos de variables">
            <thead><tr><th>Tipo</th><th>Valor</th></tr></thead>
            <tbody>
                <?php foreach ($tipos as $tipo => $valor) { ?>
                <tr>
                    <td><?php echo e($tipo); ?></td>
                    <td><?php echo is_bool($valor) ? ($valor ? 'true' : 'false') : e($valor); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2>Certificación W3C</h2>
        <p>
            <a href="https://validator.w3.org/check?uri=referer">
                <img src="https://www.w3.org/Icons/valid-xhtml10"
                    alt="Valid XHTML 1.0 Strict" height="31" width="88" />
            </a>
        </p>
    </div>
</body>
</html>