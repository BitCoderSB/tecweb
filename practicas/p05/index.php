<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>P05 – Manejo de variables en PHP</title>
  <style>
    body{font-family:system-ui, Arial, sans-serif; margin:24px; line-height:1.4}
    h1{margin:0 0 8px}
    h2{margin-top:28px}
    pre{background:#111; color:#eee; padding:12px; overflow:auto; border-radius:8px; white-space:pre-wrap}
    code{font-family:ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace}
    .ok{color:#0a0}.bad{color:#c00}
    hr{margin:28px 0}
    small{color:#666}
  </style>
</head>
<body>
  <h1>Práctica 5 – Manejo de variables en PHP</h1>

  <section id="e1">
    <h2>Ejercicio 1</h2>
    <ul>
      <li class="ok">$<strong>_myvar</strong></li>
      <li class="ok">$<strong>_7var</strong></li>
      <li class="bad"><strong>myvar</strong></li>
      <li class="ok">$<strong>myvar</strong></li>
      <li class="ok">$<strong>var7</strong></li>
      <li class="ok">$<strong>_element1</strong></li>
      <li class="bad">$<strong>house*5</strong></li>
    </ul>
  </section>
  <hr/>
</body>
</html>
