<?php

$plac=5;
$medalj="ja";

$plac<4 ? $medalj=true : $medalj=false;
var_dump ($plac, $medalj);

$user=$_GET['user'] ?? 'nobody';
var_dump($user);