<?php

declare (strict_types=1);
require_once 'funktioner.php';

$db = kopplaDatabas();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    $error = new stdClass();
    $error->error = ["Felaktigt anrop", "Sidan ska anropas med POST"];
    skickaSvar($error, 405);
}

$error= kontrolleraUppgift();
if (count($error)>0) {
    $fel=new stdClass();
    $fel->error=$error;
    skickaSvar($fel, 400);
}

$activityId= filter_input(INPUT_POST, 'activityId', FILTER_VALIDATE_INT);
$time= filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
$date= filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$description= filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$description ?? ''; // OM description är NULL blir det ''

$sql="INSERT INTO tasks (activityid, date, time, description) "
        . "VALUES (:activityId, :date, :time, :description)";
$stmt=$db->prepare($sql);
$stmt->execute(['activityId'=>$activityId, 'date'=>$date, 
    'time'=>$time, 'description'=>$description]);
$antaPoster=$stmt->rowCount();
if ($antaPoster===0) {
    $error=new stdClass();
    $error->error=["Fel vid spara", "Inga poster sparades", $stmt->errorInfo()];
    skickaSvar($error, 400);
} else {
    $nyId=$db->lastInsertId();
    $svar=new stdClass();
    $svar->message=["Spara lyckades"];
    $svar->id=$nyId;
    skickaSvar($svar, 200);
}