<?php

declare (strict_types=1);
require_once 'funktioner.php';

if (isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if ($page < 1) {
        $error = new stdClass();
        $error->error = ["Felaktig indata", "Ogiltig 'page'"];
        skickaSvar($error, 400);
    }

    $records = filter_input(INPUT_GET, 'records', FILTER_VALIDATE_INT);
    if ($records < 1) {
        $records = 20;
    }

// Räkna ut första posten att returnera
    $firstRecord = ($page - 1) * $records + 1;

    $db = kopplaDatabas();

// Hämta antalet poster för att beräkna antalet sidor
    $sql = "SELECT COUNT(*) FROM tasks";
    $stmt = $db->query($sql);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    $antalPoster = (int) $row[0];
    $antalSidor = ceil($antalPoster / $records);

    if ($page > $antalSidor) {
        $error = new stdClass();
        $error->error = ['Felaktig anrop',
            "Otillräckligt antal poster för att visa sidan $page"];
        skickaSvar($error, 400);
    }

    $sql = "SELECT t.id, activityId, activity, date, time, description "
            . "FROM tasks t "
            . "INNER JOIN activities a ON a.id=t.activityid "
            . "ORDER BY date "
            . "LIMIT $firstRecord, $records";
    $stmt = $db->prepare($sql);
    if (!$stmt->execute()) {
        $error = new stdClass();
        $error->error = ["Fel vid databasanrop", $db->errorInfo()];
        skickaSvar($error, 400);
    }

    if ($dbRecords = $stmt->fetchAll()) {
        $out = new stdClass();
        $out->pages = $antalSidor;
        foreach ($dbRecords as $row) {
            $out->tasks[] = $row;
        }
        skickaSvar($out, 200);
    } else {
        $error = new stdClass();
        $error->error = ["Fel vid hämtning", "Inga poster returnerades"];
        skickaSvar($error, 400);
    }
} elseif (isset($_GET['to']) && isset($_GET['from'])) {
    $to = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_STRING);
    $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_STRING);

    $dateTo = DateTimeImmutable::createFromFormat('Y-m-d', $to);
    $dateFrom = DateTimeImmutable::createFromFormat('Y-m-d', $from);

    if ($dateFrom === false || $dateTo === false) {
        $error = new stdClass();
        $error->error = ["Felaktig indata",
            "Felaktigt inmatade datum, ange på formen " . date('Y-m-d')];
        skickaSvar($error, 400);
    }

    if ($dateTo->format('Y-m-d') !== $to || $dateFrom->format('Y-m-d') !== $from) {
        $error = new stdClass();
        $error->error = ["Felaktig indata",
            "Felaktigt inmatade datum, ange på formen " . date('Y-m-d')];
        skickaSvar($error, 400);
    }

    if ($dateTo->format('Y-m-d') < $dateFrom->format('Y-m-d')) {
        $error = new stdClass();
        $error->error = ["Felaktig indata",
            "'to' ska vara efter 'from'"];
        skickaSvar($error, 400);
    }
    $db = kopplaDatabas();
    $sql = "SELECT t.id, activityId, date, time, activity, description "
            . "FROM tasks t "
            . "INNER JOIN activities a ON a.id=t.activityid "
            . "WHERE date BETWEEN :from AND :to "
            . "ORDER BY date ";
    $stmt = $db->prepare($sql);
    if (!$stmt->execute(['to' => $dateTo->format('Y-m-d'), 'from' => $dateFrom->format('Y-m-d')])) {
        $error = new stdClass();
        $error->error = ["Fel vid databasanrop", $sql,$db->errorInfo()];
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
} else {
    $error = new stdClass();
    $error->error = ["Ogiltigt anrop",
        "'page' ELLER 'from' och 'to' saknas"];
    skickaSvar($error, 400);
}