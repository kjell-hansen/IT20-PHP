<?php
// Ta emot texten från formuläret och lämna bort "farliga" tecken
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

// Ta bort mellanslag och bindestreck
$check=str_replace(" ", "", $text);
$check=str_replace("-", "", $check);

// Konvertera till små bokstäver
$check=mb_strtolower($check);

// Kolla om texten är samma som den omvända texten
$isPalindrom= ($check==strrev($check))

// Skriv ut sidan
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