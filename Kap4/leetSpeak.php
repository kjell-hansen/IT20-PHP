<?php
// Ta emot text och radera "farliga" tecken
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING); 

// Skapa arrayer med tecken som ska bytas
$lower=['a', 'b','e', 'g', 'i', 'o', 's', 't','z'];
$leet=['4', '8', '3', '9', '1', '0', '5', '7', '2'];

// Byt bokstäver
$leetText=str_ireplace($lower, $leet, $text);

// Skriv ut sidan
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LeetSpeak (L3375p34k) (4.3)</title>
    </head>
    <body>
        <form method="POST">
            Text: <input type="text" name="text" size=50><br>
            <input type="submit" value="Skicka">
        </form>
    <?php
        echo "$text in l347 is...<br><q>$leetText</q>";
    ?>
    </body>
</html>