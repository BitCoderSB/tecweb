<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

$mysqli = new mysqli('localhost','root','', 'marketzone');
if ($mysqli->connect_errno) { die('Error MySQL: '.$mysqli->connect_error); }
$mysqli->set_charset('utf8mb4');

$nombre=trim($_POST['nombre']??'');
$modelo=trim($_POST['modelo']??'');
$marca =trim($_POST['marca']??'');
$precio=(float)($_POST['precio']??0);
$unidades=(int)($_POST['stock']??0);      
$detalles=trim($_POST['descripcion']??'');
$imagen=trim($_POST['imagen']??'');

$errores=[];
if($nombre===''||$modelo===''||$marca==='') $errores[]='Nombre, modelo y marca son obligatorios.';
if($precio<0) $errores[]='Precio inválido.';
if($unidades<0) $errores[]='Unidades inválidas.';

$dup=0;
if(!$errores){
  $q="SELECT COUNT(*) FROM productos WHERE nombre=? AND modelo=? AND marca=?";
  $st=$mysqli->prepare($q); $st->bind_param('sss',$nombre,$modelo,$marca);
  $st->execute(); $st->bind_result($dup); $st->fetch(); $st->close();
}

$ok=false; $id=null; $err='';
if(!$errores && !$dup){
  $sql="INSERT INTO productos (nombre,modelo,marca,precio,unidades,detalles,imagen,eliminado)
        VALUES (?,?,?,?,?,?,?,0)";
  $st=$mysqli->prepare($sql);
  $st->bind_param('sssdiss',$nombre,$modelo,$marca,$precio,$unidades,$detalles,$imagen);
  if($st->execute()){ $ok=true; $id=$st->insert_id; } else { $err=$st->error; }
  $st->close();
}
?>
<!doctype html><html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Resultado</title><link rel="stylesheet" href="style.css"></head><body>
<div class="container">
  <div class="nav">
    <a href="formulario_productos.html">Nuevo</a>
    <a href="get_productos_vigentes.php">Vigentes</a>
  </div>
  <div class="card">
    <h1><?php echo $ok? 'Producto guardado':'No fue posible guardar'; ?></h1>
    <p class="sub">
      <?php
        if($ok) echo '<span class="badge-ok">OK</span>';
        elseif($dup) echo '<span class="badge-err">Duplicado</span>';
        else echo '<span class="badge-err">Error</span>';
      ?>
    </p>

    <?php if($errores): ?>
      <ul><?php foreach($errores as $e){ echo '<li>'.htmlspecialchars($e).'</li>'; } ?></ul>
    <?php elseif($dup): ?>
      <p>Ya existe un producto con el mismo <b>nombre+modelo+marca</b>.</p>
    <?php elseif(!$ok): ?>
      <p>Error MySQL: <?php echo htmlspecialchars($err); ?></p>
    <?php else: ?>
      <div class="kv">
        <div class="k">ID</div><div><?php echo (int)$id; ?></div>
        <div class="k">Nombre</div><div><?php echo htmlspecialchars($nombre); ?></div>
        <div class="k">Modelo</div><div><?php echo htmlspecialchars($modelo); ?></div>
        <div class="k">Marca</div><div><?php echo htmlspecialchars($marca); ?></div>
        <div class="k">Precio</div><div><?php echo number_format($precio,2); ?></div>
        <div class="k">Unidades</div><div><?php echo (int)$unidades; ?></div>
        <div class="k">Detalles</div><div><?php echo htmlspecialchars($detalles); ?></div>
        <div class="k">Imagen</div><div><?php echo htmlspecialchars($imagen); ?></div>
        <div class="k">Eliminado</div><div>0</div>
      </div>
    <?php endif; ?>
  </div>
</div>
</body></html>
