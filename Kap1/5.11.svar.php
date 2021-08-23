<?php

$namn=$_POST['namn'];
$fodelsedag=$_POST['fodelsedag'];
$user=$_POST['user'];
$losen=$_POST['losen'];
$telefon=$_POST['telefon'];

echo "Du skrev in följande:<br>";
echo "Namn: <i>$namn</i><br>";
echo "Födelsedag: <i>$fodelsedag</i><br>";
echo "Användarnamn: <i>$user</i><br>";
echo "Lösenord: <i>$losen</i><br>";
echo "Telefon: <i>$telefon</i><br>";