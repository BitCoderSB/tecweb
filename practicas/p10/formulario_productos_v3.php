<?php
$cn = new mysqli('localhost', 'root', '', 'tienda');
if ($cn->connect_error) {
    die('DB error');
}

$id = $_GET['id'] ?? $_POST['id'] ?? '';
$prd = [
    'id' => '',
    'nombre' => '',
    'marca' => 'Apple',
    'modelo' => '',
    'precio' => '',
    'detalles' => '',
    'unidades' => '',
    'imagen' => ''
];

if ($id !== '') {
    $st = $cn->prepare("SELECT id,nombre,marca,modelo,precio,detalles,unidades,imagen FROM productos WHERE id=?");
    $st->bind_param('i', $id);
    $st->execute();
    $res = $st->get_result();
    if ($row = $res->fetch_assoc()) {
        $prd = $row;
    }
}

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>formulario_productos_v3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .is-invalid {
            border-color: #dc3545;
        }
    </style>
</head>
<body class="p-4">
    <h4>Editar producto (v3, precarga desde BD por id)</h4>
    <form id="f" method="post" action="update_producto.php" novalidate>
        <input type="hidden" name="id" value="<?= h($prd['id']) ?>">
        
        <div class="form-group">
            <label>Nombre *</label>
            <input class="form-control" name="nombre" maxlength="100" required value="<?= h($prd['nombre']) ?>">
        </div>
        
        <div class="form-group">
            <label>Marca *</label>
            <select class="form-control" name="marca" required>
                <?php foreach (['Apple', 'Samsung', 'Sony', 'LG', 'Xiaomi', 'Otra'] as $o) {
                    $sel = $prd['marca'] === $o ? 'selected' : '';
                    echo "<option $sel>" . h($o) . "</option>";
                } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Modelo *</label>
            <input class="form-control" name="modelo" maxlength="25" required pattern="[A-Za-z0-9\- ]+" value="<?= h($prd['modelo']) ?>">
            <small class="form-text text-muted">Alfanumérico, guion y espacio.</small>
        </div>
        
        <div class="form-group">
            <label>Precio *</label>
            <input class="form-control" name="precio" type="number" step="0.01" min="0" required value="<?= h($prd['precio']) ?>">
        </div>
        
        <div class="form-group">
            <label>Detalles</label>
            <textarea class="form-control" name="detalles" maxlength="250" rows="3"><?= h($prd['detalles']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Unidades *</label>
            <input class="form-control" name="unidades" type="number" step="1" min="0" required value="<?= h($prd['unidades']) ?>">
        </div>
        
        <div class="form-group">
            <label>Ruta de imagen</label>
            <input class="form-control" name="imagen" value="<?= h($prd['imagen']) ?>">
            <small class="form-text text-muted">Vacío = cat.png.</small>
        </div>
        
        <button class="btn btn-primary" type="submit">Guardar cambios</button>
    </form>

    <script>
        const f = document.getElementById('f');
        f.addEventListener('submit', e => {
            let ok = true;
            const precio = parseFloat(f.precio.value);
            const unidades = parseInt(f.unidades.value, 10);
            
            if (!f.nombre.value.trim() || f.nombre.value.length > 100) {
                ok = false;
            }
            if (!f.marca.value.trim()) {
                ok = false;
            }
            if (!f.modelo.value.trim() || f.modelo.value.length > 25 || !/^[A-Za-z0-9\- ]+$/.test(f.modelo.value)) {
                ok = false;
            }
            if (!Number.isFinite(precio) || !(precio > 99.99)) {
                ok = false;
            }
            if (f.detalles.value && f.detalles.value.length > 250) {
                ok = false;
            }
            if (!Number.isInteger(unidades) || unidades < 0) {
                ok = false;
            }
            if (!f.imagen.value.trim()) {
                f.imagen.value = 'cat.png';
            }
            if (!ok) {
                e.preventDefault();
                f.reportValidity();
            }
        });
    </script>
</body>
</html>
