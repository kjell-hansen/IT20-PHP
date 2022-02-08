<?php

declare (strict_types=1);
require_once 'funktioner.php';

if (isset($_GET['to']) && isset($_GET['from'])) {
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
    $sql = "SELECT activityid, activity, "
            . "SEC_TO_TIME(SUM(TIME_TO_SEC(TIME)))  AS `time` "
            . "FROM tasks "
            . "INNER JOIN activities ON activities.id=tasks.activityid "
            . "WHERE date BETWEEN :from AND :to "
            . "GROUP BY activityid ";
    $stmt = $db->prepare($sql);
    if (!$stmt->execute(['to' => $dateTo->format('Y-m-d'), 'from' => $dateFrom->format('Y-m-d')])) {
        $error = new stdClass();
        $error->error = ["Fel vid databasanrop", $sql, $db->errorInfo()];
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
        "'from' och 'to' saknas"];
    skickaSvar($error, 400);
}