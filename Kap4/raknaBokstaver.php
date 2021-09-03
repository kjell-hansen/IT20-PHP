<?php
    // Variabler som används på sidan
    $result=[];
    $text="";


    // Om vi har en POST ska vi hantera indatat
    if(isset($_POST['text'])) {
        // Ta in texten och hoppa över alla "onödiga" tecken
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING); 
        
        // Radera allt utom bokstäver
        $tecken=preg_replace('/[\PL]/u', '', $text);
        
        // Gör om till små bokstäver
        $tecken=mb_strtolower($tecken);
        
        // Loopa igenom texten och ett tecken i taget lägg tecknet till bokstavs-arrayen
         for ($i = 0; $i < mb_strlen($tecken); $i++) {
            $bokstavsArray[] = mb_substr($tecken, $i, 1);
        }
        // Räkna antalet förekomster av varje tecken
        $result = array_count_values($bokstavsArray);
    } 

    
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Räkna bokstäver (4.5)</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <form method="POST">
            Ange text:<br>
            <textarea name="text" rows="4" cols="50" autofocus><?= $text; ?></textarea><br>
            <input type="submit" name="submit" value="Skicka!">
        </form>
        <?php
        if (isset($result)) {
            echo '<p>Bokstavsfrekvens:</p>';
            echo '<ul>';
            foreach ($result as $key => $value) {
                echo "<li>$key => $value</li>";
            }
            echo '</ul>';
        }
        ?>
    </body>
</html>

