<?php
require_once 'funktioner.php';

$db= kopplaDatabas();

$sql="SELECT id, activity FROM activities";
$stmt=$db->query($sql);
$resultat=$stmt->fetchAll();

$out=new stdClass();
$out->activities=[];
foreach ($resultat as $row) {
    $out->activities[]=['id'=>$row['id'], 'activity'=>$row['activity']];
}

skickaSvar($out, 200);
