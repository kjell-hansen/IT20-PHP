<?php

function kopplaDatabas(): PDO {
    $dbDSN = "mysql:dbname=tidsapp;host=127.0.0.1;port=3306;charset=utf8";
    $dbUser = "root";
    $dbPassword = "";

    try {
        $db = new PDO($dbDSN, $dbUser, $dbPassword);
    } catch (PDOException $ex) {
        $err = new stdClass();
        $err->error = [$ex->getMessage()];
        skickaSvar($err, 401);
    }
    return $db;
}

function skickaSvar(stdClass $info, int $svarsKod): void {
    header(hamtaHeader($svarsKod));
    echo json_encode($info, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    exit;
}

function hamtaHeader(int $svarsKod): string {
    $retur = ";Content-type:application/json;charset=utf-8";
    switch ($svarsKod) {
        case 200:
            $retur = "200 OK" . $retur;
            break;
        case 400:
            $retur = "400 Bad Request" . $retur;
            break;
        case 401:
            $retur = "401 Unauthorized" . $retur;
            break;
        case 405:
            $retur = "405 Method not allowed" . $retur;
            break;
        default:
            $retur = "500 Invalid Header" . $retur;
            break;
    }

    $retur = "HTTP/1.1 " . $retur;

    return $retur;
}

function kontrolleraUppgift(): array {
    $retur = [];
    if (isset($_POST['activityId'])) {
        $activityId = filter_input(INPUT_POST, 'activityId', FILTER_VALIDATE_INT);
        if ($activityId < 1) {
            $retur[] = "Felaktigt angiven 'activityId'";
        }
    } else {
        $retur[] = "'activityId' saknas";
    }

    if (isset($_POST['date'])) {
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        if ($realDate = DateTimeImmutable::createFromFormat('Y-m-d', $date)) {
            if ($realDate->format('Y-m-d') !== $date) {
                $retur[] = "Felaktigt angivet 'date' ange som " . date('Y-m-d');
            }
        } else {
            $retur[] = "Felaktigt angivet 'date' ange som " . date('Y-m-d');
        }
    } else {
        $retur[] = "'date' saknas";
    }

    if (isset($_POST['time'])) {
        $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
        if ($realTime = DateTimeImmutable::createFromFormat("H:i", $time)) {
            if ($realTime->format('H:i') !== $time) {
                $retur[] = "Felaktigt angiven 'time' ange som " . date('H:i');
            }
            if ($realTime->format('H:i') > "08:00") {
                $retur[] = "Du får redovisa högst 8:00 timmar på en uppgift";
            }
        } else {
            $retur[] = "Felaktigt angiven 'time' ange som " . date('H:i');
        }
    } else {
        $retur[] = "'time' saknas";
    }

    if (count($retur) > 0) {
        array_unshift($retur, "Fel på indata");
    }

    return $retur;
}
