<?php
declare (strict_types=1);
require_once 'funktioner.php';

$namn = "";
$steg = 0;

// Kolla om namnet finns sparat
if(isset($_COOKIE['namn'])) {
    $namn=$_COOKIE['namn'];
}

if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'Börja spela!':
            $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_STRING);
            sparaNamn($namn);
        case 'Spela igen':
            for ($i = 0; $i < 5; $i++) {
                $tarning[$i] = rullaTarning();
            }
            $antalSlag=1;
            $steg = 1;
            break;
        case 'Nästa slag':
            if($_POST['antalSlag']<2) {
                $antalSlag=$_POST['antalSlag'];
                $antalSlag++;
                $tarning=slaOmTarningar($_POST);
                $steg=1;
            } else {
                $tarning=slaOmTarningar($_POST);
                $resultat=utvarderaTarningar($tarning);
                $steg=2;
            }
            break;
        case 'Göra något tråkigt':
            header("Location: https://skatt.fi");
            exit;
        default:
            break;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Yatzy</title>
        <meta charset="UTF-8">
        <link href="css/yatzy.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Yatzy</h1>
        <?php
        include "include/steg$steg.php";
        ?>
    </body>
</html>