<?php
declare (strict_types=1);

require_once 'funktioner.php';
$db= kopplaDatabas();

if($_SERVER['REQUEST_METHOD']!=="POST") {
    $error=new stdClass();
    $error->error=["Felaktigt anrop", "Sidan ska anropas med POST"];
    skickaSvar($error, 405);
}

// Här börjar uppdatera post
if (isset($_GET['id'])){
    $id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id<1) {
        $error=new stdClass();
        $error->error=["Felaktig indata", "Ogiltigt 'id'"];
        skickaSvar($error, 400);
    }
    
    if(!isset($_POST['activity'])){
        $error=new stdClass();
        $error->error=["Felakig indata", "'activity' saknas"];
        skickaSvar($error, 400);
    }
    
    $activity= filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
    $activity=trim($activity);
    if ($activity==='') {
        $error=new stdClass();
        $error->error=["Felaktig indata", "'activity' får inte vara tom"];
        skickaSvar($error, 400);
    }
    
    $sql="SELECT * from activities WHERE id=:id";
    $stmt=$db->prepare($sql);
    $stmt->execute(['id'=>$id]);
    if (!$stmt->fetch()) {
        $error=new stdClass();
        $error->error=["Fel på indata", "Angivet 'id' finns inte ($id)"];
        skickaSvar($error, 400);
    }

    $sql="UPDATE activities SET activity=:activity WHERE id=:id";
    $stmt=$db->prepare($sql);
    $stmt->execute(['id'=>$id, 'activity'=>$activity]);
    $antalPoster=$stmt->rowCount();
    if ($antalPoster===0) {
        $svar=new stdClass();
        $svar->message=["Inga poster uppdaterades"];
        $svar->result=false;
        skickaSvar($svar, 200);
    } else {
        $svar=new stdClass();
        $svar->message=["Uppdatera lyckades" , "$antalPoster post uppdaterades"];
        $svar->result=true;
        skickaSvar($svar, 200);
    }
}

// Här börjar spara ny post!
if (!isset($_POST['activity'])) {
    $error=new stdClass();
    $error->error=["Felaktigt anrop", "Parametern 'activity' saknas"];
    skickaSvar($error, 400);
}

$activity= filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
$activity=trim($activity);
if ($activity==='') {
    $error=new stdClass();
    $error->error=["Felaktigt anrop", "'activity' får inte vara tom"];
    skickaSvar($error, 400);
}

$sql="SELECT * FROM activities WHERE activity=:activity";
$stmt=$db->prepare($sql);
$stmt->execute(['activity'=>$activity]);
if($stmt->fetch()) {
    $error=new stdClass();
    $error->error=["Felaktig indata", "Aktiviteten '$activity' finns redan"];
    skickaSvar($error, 400);
}

$sql="INSERT INTO activities (activity) VALUES (:activity)";
$stmt=$db->prepare($sql);
$stmt->execute(['activity'=>$activity]);
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