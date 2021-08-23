<?php 
$text='något annat kul';
$nyhet="viktiga saker som t.ex. $text";
$day="2021-08-18";

?>
<h1>Rubrik: <?=$text; ?></h1>
    <p>En massa HTMLtext blandat med <?= $nyhet; ?> </p>
        <?php if (date("Y-m-d")==$day) {
            echo "Dagens huvudrubriker";
        } ?>
    <p>Mer text</p>