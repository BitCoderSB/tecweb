<?php include __DIR__ . "/src/funciones.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 7 - EJ1–EJ4</title>
    <style>table{border-collapse:collapse}td,th{border:1px solid #333;padding:4px}</style>
</head>
<body>
    <h1>Práctica 7 (EJ1–EJ4)</h1>

    <h2>EJ1: ¿es múltiplo de 5 y 7?</h2>
    <form method="get">
        <label>Número: <input type="number" name="numero" required></label>
        <button>Probar</button>
    </form>
    <?php
    if (isset($_GET['numero'])) {
        $n = intval($_GET['numero']);
        echo "<p><strong>$n</strong> " . (esMultiploDe5y7($n) ? "SÍ" : "NO") . " es múltiplo de 5 y 7.</p>";
    } else {
        echo "<p>Tip: añade ?numero=35 a la URL para probar rápido.</p>";
    }
    ?>

    <h2>EJ2: generar filas [impar, par, impar] hasta que la primera cumpla</h2>
    <?php
    $res = generarImparParImpar();
    echo "<table><thead><tr><th>Col 1</th><th>Col 2</th><th>Col 3</th></tr></thead><tbody>";
    foreach ($res['matriz'] as $fila) {
        echo "<tr><td>{$fila[0]}</td><td>{$fila[1]}</td><td>{$fila[2]}</td></tr>";
    }
    echo "</tbody></table>";
    echo "<p>Total: <strong>" . ($res['iteraciones']*3) . "</strong> números en <strong>{$res['iteraciones']}</strong> iteraciones.</p>";
    ?>

    <h2>EJ3: primer número aleatorio múltiplo de M (while vs do-while)</h2>
    <form method="get">
        <label>M: <input type="number" name="m" min="1" required></label>
        <button>Buscar múltiplos</button>
    </form>
    <?php
    if (isset($_GET['m'])) {
        $m = max(1, intval($_GET['m']));
        $r1 = primerMultiploWhile($m);
        $r2 = primerMultiploDoWhile($m);
        echo "<p><strong>While</strong>: {$r1['numero']} en {$r1['intentos']} intentos</p>";
        echo "<p><strong>Do-while</strong>: {$r2['numero']} en {$r2['intentos']} intentos</p>";
    } else {
        echo "<p>Tip: añade ?m=13 a la URL para probar rápido.</p>";
    }
    ?>

    <h2>EJ4: arreglo ASCII (97..122 → a..z)</h2>
    <?php
    $arr = arregloAsciiAZ();
    echo "<table><thead><tr><th>Código</th><th>Carácter</th></tr></thead><tbody>";
    foreach ($arr as $k=>$v) { echo "<tr><td>$k</td><td>$v</td></tr>"; }
    echo "</tbody></table>";
    ?>

</body>
</html>