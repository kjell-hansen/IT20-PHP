<?php
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

$check=str_replace(" ", "", $text);
$check=str_replace("-", "", $check);
$check=mb_strtolower($check);

$isPalindrom= ($check==strrev($check))

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Palindrom (4.1)</title>
    </head>
    <body>
        <form method="POST">
            Text: <input type="text" name="text" size=50><br>
            <input type="submit" value="Skicka">
        </form>
    <?php 
        if($isPalindrom) {
            echo "$text är ett palindrom";
        } else {
            echo "$text är inget palindrom";
        }
    ?>
    </body>
</html>