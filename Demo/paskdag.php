<?php
declare (strict_types=1);
// set the default timezone to use.
date_default_timezone_set('EET');

$ar= filter_input(INPUT_GET, "ar", FILTER_VALIDATE_INT);
if (is_null($ar) || $ar===false || $ar>2037 || $ar<1970) {
    header("HTTP/1.1 400 Bad request");
    echo "Error 400, Bad request";
    exit;
}

$timestamp = easter_date($ar);
$datum= date("Y-m-d", $timestamp);

$json=new stdClass();
$json->År=$ar;
$json->Datum=$datum;

// Skriv ut header-information
header("Content-type:application/json;charset=UTF-8");
// Sriv ut objektet som ett json-objekt, formattera det snyggt och escapa unicode-tecken
echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);