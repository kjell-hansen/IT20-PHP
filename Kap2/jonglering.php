<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Uppgift 2.1 Jonglering</title>
    </head>
    <body>
        <h1>Uppgift 2.1 - Jonglering</h1>
        <form method="GET">
            Skriv in text: <input type="text" name="text"><br>
            <input type="submit" value="Sänd">
        </form>
<?php
    $text=$_GET["text"];
    
    echo "Från formuläret: $text<br>";
    $int=(int) $text;
    echo "Som heltal $int <br>";
    $float=(float) $text;
    echo "Som flyttal: $float <br>";
    $bool=(bool) $text;
    echo "Som boolean: $bool <br>";
    
?>
    </body>
</html>
