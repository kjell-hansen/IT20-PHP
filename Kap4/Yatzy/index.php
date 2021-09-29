<?php
declare (strict_types=1);
require_once 'funktioner.php';

$namn = "";
$steg = 0;

if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'Börja spela!':
            $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_STRING);
            sparaNamn($namn);
            for ($i = 0; $i < 5; $i++) {
                $tarning[$i] = rullaTarning();
            }
            $antalSlag=1;
            $steg = 1;
            break;
        case 'Nästa slag':
            var_dump($_POST);
            if($_POST['antalSlag']<2) {
                $antalSlag=$_POST['antalSlag'];
                $antalSlag++;
                $tarning=slaOmTarningar($_POST);
                $steg=1;
            } else {
                $resultat=utvarderaTarningar($_POST);
                $steg=2;
            }
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
    </head>
    <body>
        <h1>Yatzy</h1>
        <?php
        include "include/steg$steg.php";
        ?>
    </body>
</html>