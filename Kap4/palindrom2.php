<?php
// Ta emot texten från formuläret, ta bort "onödiga" tecken
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

// Ta bort mellanslag och bindestreck från texten
$check=str_replace(" ", "", $text);
$check=str_replace("-", "", $check);

// Gör om till små bokstäver
$check=mb_strtolower($check);

// Loopa igenom strängen
$baklanges="";
for($i=1;$i<=mb_strlen($check);$i++) {
    // Fyll på strängen med tecknen från slutet av det inmatade
    $baklanges.=mb_substr($check, -$i, 1);
}

// Kolla om baklängestexten är samma som den inmatade (och justerade) texten
$isPalindrom= ($check==$baklanges)

// Skriv ut sidan
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Palindrom (4.1 överkurs för mb-strängar)</title>
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
            echo "$text är inget palindrom ($check != $baklanges)";
        }
    ?>
    </body>
</html>