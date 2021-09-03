<?php
// Ta emot text och radera "farliga" tecken
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING); 

// Konvertera texten så att alla ord börjar med versal
$text=mb_convert_case($text, MB_CASE_TITLE);

// Ta bort alla mellanslag
$text=str_replace(" ","",$text);

// Sätt första bokstaven till gemener
$forsta=mb_substr($text,0,1);
$resten=mb_substr($text, 1);
$forsta=mb_convert_case($forsta, MB_CASE_LOWER);
$text=$forsta . $resten;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>camelCase (4.2 överkurs för mb-strängar)</title>
    </head>
    <body>
        <form method="POST">
            Text: <input type="text" name="text" size=50><br>
            <input type="submit" value="Skicka">
        </form>
    <?php 
        
            echo "$text";
        
    ?>
    </body>
</html>