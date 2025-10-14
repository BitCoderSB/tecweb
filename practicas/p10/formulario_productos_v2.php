<?php
$src = $_POST + $_GET;
$id = $src['id'] ?? '';
$nombre = $src['nombre'] ?? '';
$marca = $src['marca'] ?? '';
$modelo = $src['modelo'] ?? '';
$precio = $src['precio'] ?? '';
$detalles = $src['detalles'] ?? '';
$unidades = $src['unidades'] ?? '';
$imagen = $src['imagen'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>formulario_productos_v2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .is-invalid {
            border-color: #dc3545;
        }
    </style>
</head>
<body class="p-4">
    <h4>Editar producto</h4>
    <form id="f" method="post" action="update_producto.php" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        
        <div class="form-group">
            <label>Nombre *</label>
            <input class="form-control" name="nombre" maxlength="100" required value="<?= htmlspecialchars($nombre) ?>">
            <div class="invalid-feedback">Requerido. Máx 100.</div>
        </div>
        
        <div class="form-group">
            <label>Marca *</label>
            <select class="form-control" name="marca" required>
                <?php foreach (['Apple', 'Samsung', 'Sony', 'LG', 'Xiaomi', 'Otra'] as $o) {
                    $sel = $marca === $o ? 'selected' : '';
                    echo "<option $sel>" . htmlspecialchars($o) . "</option>";
                } ?>
            </select>
            <div class="invalid-feedback">Selecciona una marca.</div>
        </div>
        
        <div class="form-group">
            <label>Modelo *</label>
            <input class="form-control" name="modelo" maxlength="25" required pattern="[A-Za-z0-9\- ]+" value="<?= htmlspecialchars($modelo) ?>">
            <small class="form-text text-muted">Alfanumérico, guion y espacio.</small>
            <div class="invalid-feedback">Inválido o >25.</div>
        </div>
        
        <div class="form-group">
            <label>Precio *</label>
            <input class="form-control" name="precio" type="number" step="0.01" min="0" required value="<?= htmlspecialchars($precio) ?>">
            <div class="invalid-feedback">Debe ser > 99.99.</div>
        </div>
        
        <div class="form-group">
            <label>Detalles</label>
            <textarea class="form-control" name="detalles" maxlength="250" rows="3"><?= htmlspecialchars($detalles) ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Unidades *</label>
            <input class="form-control" name="unidades" type="number" step="1" min="0" required value="<?= htmlspecialchars($unidades) ?>">
            <div class="invalid-feedback">≥ 0.</div>
        </div>
        
        <div class="form-group">
            <label>Ruta de imagen</label>
            <input class="form-control" name="imagen" value="<?= htmlspecialchars($imagen) ?>">
            <small class="form-text text-muted">Vacío = cat.png.</small>
        </div>
        
        <button class="btn btn-primary" type="submit">Guardar cambios</button>
    </form>

    <script>
        const f = document.getElementById('f');

        function setErr(el, msg) {
            el.setCustomValidity(msg);
            el.classList.add('is-invalid');
        }

        function setOk(el) {
            el.setCustomValidity('');
            el.classList.remove('is-invalid');
        }

        f.addEventListener('submit', (e) => {
            let ok = true;

            if (!f.nombre.value.trim() || f.nombre.value.length > 100) {
                setErr(f.nombre, 'Requerido. Máx 100.');
                ok = false;
            } else {
                setOk(f.nombre);
            }

            if (!f.marca.value.trim()) {
                setErr(f.marca, 'Selecciona una marca.');
                ok = false;
            } else {
                setOk(f.marca);
            }

            const mdl = f.modelo.value.trim();
            if (!mdl || mdl.length > 25 || !/^[A-Za-z0-9\- ]+$/.test(mdl)) {
                setErr(f.modelo, 'Inválido o >25.');
                ok = false;
            } else {
                setOk(f.modelo);
            }

            const precio = parseFloat(f.precio.value);
            if (!Number.isFinite(precio) || !(precio > 99.99)) {
                setErr(f.precio, 'Debe ser > 99.99.');
                ok = false;
            } else {
                setOk(f.precio);
            }

            if (f.detalles.value && f.detalles.value.length > 250) {
                setErr(f.detalles, 'Máx 250.');
                ok = false;
            } else {
                setOk(f.detalles);
            }

            const unidades = parseInt(f.unidades.value, 10);
            if (!Number.isInteger(unidades) || unidades < 0) {
                setErr(f.unidades, '≥ 0.');
                ok = false;
            } else {
                setOk(f.unidades);
            }

            if (!f.imagen.value.trim()) {
                f.imagen.value = 'cat.png';
            }

            if (!ok) {
                e.preventDefault();
                f.reportValidity();
            }
        });

        ['input', 'change'].forEach(ev => {
            f.addEventListener(ev, (e) => {
                if (e.target && e.target.setCustomValidity) {
                    setOk(e.target);
                }
            });
        });
    </script>
</body>
</html>
