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

  <section id="e2">
    <h2>Ejercicio 2</h2>
    <pre><?php
      $a = "ManejadorSQL";
      $b = 'MySQL';
      $c = &$a;
      var_dump($a, $b, $c);
      $a = "PHP server";
      $b = &$a;
      var_dump($a, $b, $c);
    ?></pre>
    <?php unset($a,$b,$c); ?>
  </section>
  <hr/>

  <section id="e3">
    <h2>Ejercicio 3</h2>
    <pre><?php
      $a = "PHP5"; echo '$a = "PHP5" => '; var_dump($a);
      $z = []; $z[] = &$a; echo '$z[] = &$a => '; print_r($z);
      $b = "5a version de PHP"; echo '$b = "5a version de PHP" => '; var_dump($b);
      $c = $b * 10; echo '$c = $b * 10 => '; var_dump($c);
      $a .= $b; echo '$a .= $b => '; var_dump($a);
      $b *= $c; echo '$b *= $c => '; var_dump($b);
      $z[0] = "MySQL"; echo '$z[0] = "MySQL" => '; print_r($z);
    ?></pre>
    <?php unset($a,$b,$c,$z); ?>
  </section>
  <hr/>

  <section id="e4">
    <h2>Ejercicio 4</h2>
    <pre><?php
      $a = "PHP5"; $z=[]; $z[]=&$a; $b="5a version de PHP"; $c = $b*10; $a.=$b; $b*=$c; $z[0]="MySQL";
      print_r($GLOBALS['a']); print_r($GLOBALS['b']); print_r($GLOBALS['c']); print_r($GLOBALS['z']);
      function leerGlobales(){ global $a,$b,$c,$z; var_dump($a,$b,$c); print_r($z); }
      leerGlobales();
    ?></pre>
    <?php unset($a,$b,$c,$z); ?>
  </section>
  <hr/>

  <section id="e5">
    <h2>Ejercicio 5</h2>
    <pre><?php
      $a = "7 personas";
      $b = (integer)$a;
      $a = "9E3";
      $c = (double)$a;
      var_dump($a, $b, $c);
    ?></pre>
    <?php unset($a,$b,$c); ?>
  </section>
  <hr/>

  <section id="e6">
    <h2>Ejercicio 6</h2>
    <pre><?php
      $a = "0"; $b = "TRUE"; $c = FALSE;
      $d = ($a OR $b);
      $e = ($a AND $c);
      $f = ($a XOR $b);
      var_dump($a,$b,$c,$d,$e,$f);
      echo 'c => ' . var_export($c, true) . "\n";
      echo 'e => ' . var_export($e, true) . "\n";
    ?></pre>
    <?php unset($a,$b,$c,$d,$e,$f); ?>
  </section>
  <hr/>
</body>
</html>
