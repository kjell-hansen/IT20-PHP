<?php
if (isset($_POST['fornamn'])) {
    // Ta hand om indata
    $fornamn = filter_input(INPUT_POST, 'fornamn', FILTER_SANITIZE_STRING);
    $efternamn = filter_input(INPUT_POST, 'efternamn', FILTER_SANITIZE_STRING);
    $gatuadress = filter_input(INPUT_POST, 'gatuadress', FILTER_SANITIZE_STRING);
    $postnr = filter_input(INPUT_POST, 'postnr', FILTER_SANITIZE_STRING);
    $ort = filter_input(INPUT_POST, 'ort', FILTER_SANITIZE_STRING);
    $telefon = filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_STRING);

    // Koppla mot databasen
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $db = mysqli_connect($dbHost, $dbUser, $dbPassword, "accesskopia");

    //Kontrollera att kopplingen lyckas
    if (mysqli_connect_errno()) {
        echo "Kopplingen misslyckades:" . mysqli_connect_errno();
        exit;
    }
    mysqli_set_charset($db, 'utf8');
    
    // Skapa insert-kommandot
    $sql="INSERT INTO medlemmar (fornamn, efternamn, gatuadress, postnr, ort, telefon) "
            . " VALUES ('$fornamn', '$efternamn', '$gatuadress', '$postnr', '$ort', '$telefon')";

    // Exekvera
    mysqli_query($db, $sql);
    
    mysqli_close($db);
}
?>
<html>
    <head>
        <title>Spara data</title>
        <meta charset="utf8">
    </head>
    <body>
        <form method="POST">
            Ange förnamn: <input type="text" name="fornamn"><br>
            Ange efternamn: <input type="text" name="efternamn"><br>
            Ange adress: <input type="text" name="gatuadress"><br>
            Ange postnr: <input type="text" name="postnr"><br>
            Ange ort: <input type="text" name="ort"><br>
            Ange telefon: <input type="text" name="telefon"><br>
            <input type="submit" value="Skicka!">
        </form>
        <?php
            include 'LasMedlemmar.php';
        ?>
    </body>
</html>