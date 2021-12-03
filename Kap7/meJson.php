<?php
declare (strict_types=1);

// Skapa ett objekt 
$me=new stdClass();
// Sätt egenskaper på objektet
$me->namn="Kjell";
$me->fodd="18 jan";

// Skriv ut header-information
header("Content-type:application/json;charset=UTF-8");
// Sriv ut objektet som ett json-objekt, formattera det snyggt och escapa unicode-tecken
echo json_encode($me, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);