<?php

$dbHost="localhost";$dbUser="root";$dbPassword="";
$db= mysqli_connect($dbHost, $dbUser, $dbPassword, "accesskopia");

//Kontrollera att kopplingen lyckas
if(mysqli_connect_errno()) {
    echo "Kopplingen misslyckades:" . mysqli_connect_errno();
    exit;
}
mysqli_set_charset($db, 'utf8');

// Hämta data
$result= mysqli_query($db, "select fornamn, efternamn, ort from medlemmar");
echo mysqli_num_rows($result) . " rader returnerades<br>";

// Visa alla raderna
while($row= mysqli_fetch_array($result)) {
    echo "$row[fornamn] $row[efternamn], $row[ort]<br>";
}

mysqli_close($db);
