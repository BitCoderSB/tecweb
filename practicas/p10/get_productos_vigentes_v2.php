<?php
$cn = new mysqli('localhost', 'root', '', 'tienda');
$q = $cn->query("SELECT * FROM productos WHERE eliminado=0 ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>get_productos_vigentes_v2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h4>Productos vigentes</h4>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $q->fetch_assoc()): ?>
            <tr data-id="<?= $r['id'] ?>">
                <td><?= $r['id'] ?></td>
                <td class="c-nombre"><?= $r['nombre'] ?></td>
                <td class="c-marca"><?= $r['marca'] ?></td>
                <td class="c-modelo"><?= $r['modelo'] ?></td>
                <td class="c-precio"><?= $r['precio'] ?></td>
                <td class="c-unidades"><?= $r['unidades'] ?></td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="editar(this)">Editar</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        function editar(btn) {
            const tr = btn.closest('tr');
            const datos = {
                id: tr.dataset.id,
                nombre: tr.querySelector('.c-nombre').textContent,
                marca: tr.querySelector('.c-marca').textContent,
                modelo: tr.querySelector('.c-modelo').textContent,
                precio: tr.querySelector('.c-precio').textContent,
                detalles: '',
                unidades: tr.querySelector('.c-unidades').textContent,
                imagen: ''
            };
            
            const f = document.createElement('form');
            f.method = 'POST';
            f.action = 'formulario_productos_v2.php';
            
            for (const [k, v] of Object.entries(datos)) {
                const i = document.createElement('input');
                i.name = k;
                i.value = v;
                f.appendChild(i);
            }
            
            document.body.appendChild(f);
            f.submit();
        }
    </script>
</body>
</html>
