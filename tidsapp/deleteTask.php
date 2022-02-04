<?php
declare (strict_types=1);
require_once 'funktioner.php';

$db = kopplaDatabas();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    $error = new stdClass();
    $error->error = ["Felaktigt anrop", "Sidan ska anropas med POST"];
    skickaSvar($error, 405);
}

if (!isset($_POST['id'])) {
    $error = new stdClass();
    $error->error = ["Felaktig indata", "'id' saknas"];
    skickaSvar($error, 400);
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id < 1) {
    $error = new stdClass();
    $error->error = ["Felaktig indata", "Ogiltigt 'id'"];
    skickaSvar($error, 400);
}

$sql="DELETE FROM tasks WHERE id=:id";
$stmt=$db->prepare($sql);
$stmt->execute(['id'=>$id]);
$antaPoster=$stmt->rowCount();
if ($antaPoster===0) {
    $svar=new stdClass();
    $svar->result=false;
    $svar->message=["Inga poster raderades"];
    skickaSvar($svar, 200);
} else {
    $svar=new stdClass();
    $svar->result=true;
    $svar->message=["Radera lyckades", "$antaPoster poster raderades"];
    skickaSvar($svar, 200);   
}
