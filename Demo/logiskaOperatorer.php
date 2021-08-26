<?php

$a='Kalle ' . 'Nilsson';
$b = !$a;
$c=3 or 7;
$d=3 && 7;
echo "$a,$b,$c,$d<br>";

$a=true && false;
var_dump($a, $b, $c, $d);

$a=true and false;
var_dump($a);

