<?php

require_once 'funktioner.php';

if (!isset($_GET['id'])) {
    $error = new stdClass();
    $error->error = ["Felaktigt indata", "Parametern 'id' saknas"];
    skickaSvar($error, 400);
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id < 1) {
    $error = new stdClass();
    $error->error = ["Felaktigt indata", "Ogiltigt 'id'"];
    skickaSvar($error, 400);
}

$db=kopplaDatabas();

$sql = "SELECT id, activity FROM activities WHERE id=:id";
$stmt = $db->prepare($sql);
if (!$stmt->execute(['id' => $id])) {
    $error = new stdClass();
    $error->error = ["Fel vid databasanrop", $db->errorInfo()];
    skickaSvar($error, 400);
}

if ($record = $stmt->fetchAll()) {
    $out = new stdClass();
    $out->id = $record[0]['id'];
    $out->activity = $record[0]['activity'];
    skickaSvar($out, 200);
} else {
    $out = new stdClass();
    $out->error = ["Post saknas", "id=$id finns inte"];
    skickaSvar($out, 400);
}