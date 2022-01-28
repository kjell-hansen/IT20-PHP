<?php

declare (strict_types=1);

require_once 'funktioner.php';

// Kontrollera att vi har rätt inparameter
if(!isset($_GET['id'])) {
    $error = new stdClass();
    $error->error = ["Felaktigt indata", "Parametern 'id' saknas"];
    skickaSvar($error, 400);
}

// Kontrollera att inparametern har rätt format
$id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id < 1) {
    $error = new stdClass();
    $error->error = ["Felaktigt indata", "Ogiltigt 'id'"];
    skickaSvar($error, 400);
}

$db= kopplaDatabas();

$sql="SELECT t.id, activityid, activity, date, time, description "
        . "FROM tasks t "
        . "INNER JOIN activities a ON a.id=t.activityid "
        . "WHERE t.id=:id";
$stmt = $db->prepare($sql);
if (!$stmt->execute(['id' => $id])) {
    $error = new stdClass();
    $error->error = ["Fel vid databasanrop", $db->errorInfo()];
    skickaSvar($error, 400);
}

if ($record = $stmt->fetchObject()) {
    skickaSvar($record, 200);
} else {
    $out = new stdClass();
    $out->error = ["Post saknas", "id=$id finns inte"];
    skickaSvar($out, 400);
}