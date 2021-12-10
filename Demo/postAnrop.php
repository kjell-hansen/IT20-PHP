<?php
declare (strict_types=1);

if ($_SERVER['REQUEST_METHOD']!='POST') {
    header("HTTP/1.1 405 Method not allowed");
    echo "<h1>405</h1>";
    echo "Du ska anropa den här sidan med ett POST-anrop!";
    exit();
}

$json=new stdClass();
foreach ($_POST as $key => $value) {
    $param[$key]=$value;
}
$json->Parametrar=$param;

// Skriv ut header-information
header("Content-type:application/json;charset=UTF-8");
// Sriv ut objektet som ett json-objekt, formattera det snyggt och escapa unicode-tecken
echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);