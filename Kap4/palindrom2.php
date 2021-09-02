<?php
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

$check=str_replace(" ", "", $text);
$check=str_replace("-", "", $check);
$check=mb_strtolower($check);

$baklanges="";
for($i=1;$i<=mb_strlen($check);$i++) {
    $baklanges.=mb_substr($check, -$i, 1);
}
$isPalindrom= ($check==$baklanges)

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