<?php

declare (strict_types=1);
require_once 'funktioner.php';

if (!isset($_GET['page'])) {
    $error = new stdClass();
    $error->error = ["Felaktig indata", "'page' saknas"];
    skickaSvar($error, 400);
}

$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
if ($page < 1) {
    $error = new stdClass();
    $error->error = ["Felaktig indata", "Ogiltig 'page'"];
    skickaSvar($error, 400);
}

$records = filter_input(INPUT_GET, 'records', FILTER_VALIDATE_INT);
if ($records < 1) {
    $records = 2; // 20;
}

// Räkna ut första posten att returnera
$firstRecord = ($page - 1) * $records + 1;

$db = kopplaDatabas();
$sql = "SELECT t.id, activityid, activity, date, time, description "
        . "FROM tasks t "
        . "INNER JOIN activities a ON a.id=t.activityid "
        . "ORDER BY date "
        . "LIMIT 1, 2"; // Byt till beräknade värden!
$stmt = $db->prepare($sql);
if (!$stmt->execute()) {
    $error = new stdClass();
    $error->error = ["Fel vid databasanrop", $db->errorInfo()];
    skickaSvar($error, 400);
}

if ($dbRecords = $stmt->fetchAll()) {
    $out = new stdClass();
    foreach ($dbRecords as $row) {
        $out->tasks[] = $row;
    }
    skickaSvar($out, 200);
} else {
    $error = new stdClass();
    $error->error = ["Fel vid hämtning", "Inga poster returnerades"];
    skickaSvar($error, 400);
}
