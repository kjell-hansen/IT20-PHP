<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$db = mysqli_connect($dbHost, $dbUser, $dbPassword, "world");

//Kontrollera att kopplingen lyckas
if (mysqli_connect_errno()) {
    echo "Kopplingen misslyckades:" . mysqli_connect_errno();
}
mysqli_set_charset($db, 'utf8');

// Ta hand om formulärdata
if (isset($_POST['skicka'])) {
    $land = filter_input(INPUT_POST, 'landkod', FILTER_SANITIZE_STRING);
} else {
    $land = "";
}
?>
<html>
    <head>
        <title>Länder i en dropdown</title>
        <meta charset="utf8">
    </head>
    <h1>Länder i världen</h1>
    <form method="POST">
        Välj från listan: <?php echo landsDropdown($db, $land); ?><br>
        <input type="submit" name="skicka" value="Skicka!">
    </form>
</html>

<?php

function landsDropdown($db, $land): string {
// Hämta data
    $result = mysqli_query($db, "select code, name from country");

// Loopa alla raderna och lägg in i select-kontrollen
    $select = "<select name='landkod'>";
    while ($row = mysqli_fetch_array($result)) {
        if ($land === $row['code']) {
            $select .= "<option value='$row[code]' selected>$row[name]</option>";
        } else {
            $select .= "<option value='$row[code]'>$row[name]</option>";
        }
    }
    $select .= "</select>";

    // Returnera strängen
    return $select;
}
