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

// Ta hand om inmatning
if (isset($_POST['skicka'])) {
    $region = filter_input(INPUT_POST, "region", FILTER_SANITIZE_STRING);
} else {
    $region = "";
}
?>
<html>
    <head>
        <title>Medellivslängd för länder i en vald region</title>
        <meta charset="utf8">
    </head>
    <body>
        <form method="POST">
            Välj region: <?= regionDropdown($db, $region); ?><br>
            <input type="submit" name="skicka" value="Skicka!">
        </form>
        <hr>
        <table>
            <?= regionTabell($db, $region); ?>
        </table>
    </body>
</html>

<?php

function regionDropdown($db, $region) {
    // Skapa selectrutan
    $select = "<select name='region'>";
    if ($region !== "") {
        $select .= "<option selected>$region</option>";
    }

    $sql = "SELECT DISTINCT region FROM country";
    $result = mysqli_query($db, $sql);
    // Loopa resultatsettet och lägg till options
    while ($row = mysqli_fetch_array($result)) {
        if ($region !== $row['region']) {
            $select .= "<option>$row[region]</option>";
        }
    }
    // Avsluta dropdown-rutan
    $select .= "</select>";
    // Returnera svaret
    return $select;
}

function regionTabell($db, $region) {
    if($region==="") {
        return "";
    }

    // Förbered exekvering
    $sql="SELECT name, lifeExpectancy FROM country WHERE region=?";
    $stmt= mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $region);
    
    // Exekvera
    mysqli_stmt_execute($stmt);
    
    // Hämta resultat
    $result= mysqli_stmt_get_result($stmt);
    
    // Loopa resultatet
    $lista="<tr><th>Land</th><th>Medellivslängd</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
        $lista.="<tr><td>$row[name]</td><td>$row[lifeExpectancy]</td></tr>";
    }
    
    return $lista;
}
