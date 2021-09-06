<?php

$idag=date('l j F Y');
echo "Idag är $idag<br>";

$omEnVecka=date("Y-m-d", strtotime("+1 week"));
echo "Om en vecka är det $omEnVecka<br>";

$fosstaTossdanIMass=date("Y-m-d", strtotime("first Thursday of march 2022"));
echo "Smålänningarnas nationaldag: $fosstaTossdanIMass<br>";

$date=date_create();
var_dump (date_add($date, date_interval_create_from_date_string('1000 days')));

$datetime1=new DateTime("2009-10-11");
$datetime2=new DateTime("2009-10-13");
$interval=$datetime1->diff($datetime2);
echo "Skillnaden är " . $interval->format('%R%a days');
