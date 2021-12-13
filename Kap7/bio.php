<?php
// Skapa en array för varje sal, varje dag med filmer och visnings tid
$so_1=["16:00"=>"Encanto", "18:00"=>"Sagan om Karl-Bertil Jonssons julafton", "20:15"=>"West Side Story"];
$mo_1=["18:00"=>"Sagan om Karl-Bertil Jonssons julafton", "20:15"=>"House of Gucci"];
$ti_1=["18:00"=>"Ghostbusters: Afterlife", "20:20"=>"West Side Story"];
$on_1=["18:00"=>"Tunturin Tarina - Sagan om fjället", "20:00"=>"House of Gucci"];
$to_1=["18:00"=>"Sagan om Karl-Bertil Jonssons julafton", "20:15"=>"West Side Story"];

$so_2=["16:15"=>"Ron rör om", "18:15"=>"Tryffeljägarna från Piemonte", "20:00"=>"House of Gucci"];
$mo_2=["18:15"=>"Ghostbusters: Afterlife", "20:30"=>"Tryffeljägarna från Piemonte"];
$ti_2=["18:15"=>"Tryffeljägarna från Piemonte", "20:00"=>"Den svavelgula himlen"];
$on_2=["18:15"=>"Ghostbusters: Afterlife", "20:30"=>"West Side Story"];
$to_2=["18:15"=>"Den svavelgula himlen", "20:30"=>"House of Gucci"];

// Skapa ett bio-objekt
$bio=new stdClass();

// Skapa ett objekt för varje sal
$sal1=new stdClass();
$sal2=new stdClass();

// Lägg till salarna till bio-objektet
$bio->Sal_1=$sal1;
$bio->Sal_2=$sal2;

// Lägg till programmer för varje dag till respektive fält
$sal1->Söndag=$so_1;
$sal1->Måndag=$mo_1;
$sal1->Tisdag=$ti_1;
$sal1->Onsdag=$on_1;
$sal1->Torsdag=$to_1;

$sal2->Söndag=$so_2;
$sal2->Måndag=$mo_2;
$sal2->Tisdag=$ti_2;
$sal2->Onsdag=$on_2;
$sal2->Torsdag=$to_2;


// Skriv ut header-information
header("Content-type:application/json;charset=UTF-8");
// Sriv ut objektet som ett json-objekt, formattera det snyggt och escapa unicode-tecken
echo json_encode($bio,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
