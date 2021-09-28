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
            $steg = 1;
            break;

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
        include "html/steg$steg.html";
        ?>
    </body>
</html>