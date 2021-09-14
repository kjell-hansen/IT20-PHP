<?php
declare (strict_types=1);

// Ta emot uppgifter från formuläret
$namn=filter_input(INPUT_POST, "namn", FILTER_SANITIZE_STRING);
$hidden=filter_input(INPUT_POST, "hidden", FILTER_SANITIZE_STRING);

if($hidden=='') {
    // Skapa en sammanfogad sträng med värdena från formuläret
    $hidden=$namn . "";
} else {
    $hidden=$hidden . "|" . $namn;
}

// Skapa en array
$namnArray=explode("|", $hidden);

// Sortera arrayen
sort($namnArray, SORT_LOCALE_STRING);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sortera namn (4.10)</title>
        <meta charset="UTF-8">
     </head>
    <body>
        <h1>Sortera namn</h1>
        <form method="POST">
            Ange namn: <input type="text" name="namn"><br>
            <input type="submit" value="Spara"><br>
            <input type="hidden" name="hidden" size="100" 
                value="<?= $hidden; ?>">
        </form>
        <?php 
            // Skriv ut namnen på en egen rad
            foreach($namnArray as $n){
                echo "$n<br>";
            }
        ?>
     </body>
</html>