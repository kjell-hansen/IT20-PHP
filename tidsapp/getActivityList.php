<?php

$dbDSN = "mysql:dbname=tidsapp;host=127.0.0.1;port=3306;charset=utf8";
$dbUser = "root";
$dbPassword = "";

try {
    $db = new PDO($dbDSN, $dbUser, $dbPassword);
} catch (PDOException $ex) {
    $err=new stdClass();
    $err->error=[$ex->getMessage()];
    header("HTTP/1.1 401 Unauthorized;Content-type:application/json;charset=utf-8");
    echo json_encode($err, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql="SELECT id, activity FROM activities";
$stmt=$db->query($sql);
$resultat=$stmt->fetchAll();

$out=new stdClass();
$out->activities=[];
foreach ($resultat as $row) {
    $out->activities[]=['id'=>$row['id'], 'activity'=>$row['activity']];
}
header("HTTP/1.1 200 OK;Content-type:application/json;charset=utf-8");
echo json_encode($out, JSON_UNESCAPED_UNICODE);
