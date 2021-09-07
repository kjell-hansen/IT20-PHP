<?php
if(isset($_POST['fDag'])) {
    $fDag=new DateTimeImmutable($_POST['fDag']);
    $dagar=$_POST['dagar'];
    $antalDagar=$fDag->diff(new DateTime());
    $nyDag=$fDag->add(date_interval_create_from_date_string("$dagar days"));
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Räkna dagar (4.7)</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <form method="POST">
            Din födelsedag:<input type="date" name="fDag"><br>
            Ange antal dagar:<input type="number" name="dagar"><br>
            <input type="submit" name="submit" value="Skicka!">
        </form>
        <?php
        if(isset($_POST['fDag'])) {
            echo "$dagar dagar efter " . $fDag->format("Y-m-d") . " är det " . $nyDag->format("Y-m-d") . "<br>";
            echo "Idag (" . date("Y-m-d") . ") är det " . $antalDagar->format("%a") . " dagar sen " .$fDag->format("Y-m-d");
        }
        ?>
    </body>
</html>
