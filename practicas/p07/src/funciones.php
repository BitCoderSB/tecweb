<?php
function esMultiploDe5y7(int $n): bool {
    return $n % 5 === 0 && $n % 7 === 0;
}


function generarImparParImpar(): array {
    $matriz = [];
    $iter = 0;
    do {
        $a = rand(1, 100);
        $b = rand(1, 100);
        $c = rand(1, 100);
        $matriz[] = [$a, $b, $c];
        $iter++;
    } while (!(($a % 2) === 1 && ($b % 2) === 0 && ($c % 2) === 1));
    return ["matriz" => $matriz, "iteraciones" => $iter];
}


function primerMultiploWhile(int $m): array {
    $intentos = 0;
    while (true) {
        $num = rand(1, 100);
        $intentos++;
        if ($num % $m === 0) {
            return ["numero" => $num, "intentos" => $intentos];
        }
    }
}


function primerMultiploDoWhile(int $m): array {
    $intentos = 0;
    do {
        $num = rand(1, 100);
        $intentos++;
    } while ($num % $m !== 0);
    return ["numero" => $num, "intentos" => $intentos];
}


function arregloAsciiAZ(): array {
    $arr = [];
    for ($i = 97; $i <= 122; $i++) {
        $arr[$i] = chr($i);
    }
    return $arr;
}
