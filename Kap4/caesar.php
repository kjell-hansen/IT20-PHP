<?php
// Ta emot text och radera "farliga" tecken
$text=filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING); 

// Skapa sträng med tecken som ska bytas
$lower="abcdefghijklmnopqrstuvwxyzåäö";
$upper="ABCDEFGHIJKLMNOPQRSTUVWXYZÅÄÖ";

// Ska vi kryptera eller dekryptera?
if (isset($_POST['kryptera'])) {
    $steg=1;
} else {
    $steg=-1;
}

// Byt bokstäver
$svar="";
for($i=0;$i<mb_strlen($text);$i++) {
    // Ta en bokstav i taget
    $bokstav=mb_substr($text, $i, 1);
    // Liten bokstav?
    if (mb_strpos($lower, $bokstav)>-1) {
        // Hämta bokstaven närmast efter aktuell bokstav i alfabetet
        $svar .= mb_substr($lower, (mb_strpos($lower, $bokstav)+$steg)%mb_strlen($lower),1);
    } // Stor bokstav?
    elseif (mb_strpos($upper, $bokstav)>-1) {
        // Hämta bokstaven närmast efter aktuell bokstav i alfabetet
        $svar .= mb_substr($upper, (mb_strpos($upper, $bokstav)+$steg)%mb_strlen($upper),1);
    } // Ingetdera - Lägg in bokstaven i resultatet 
    else {
        $svar .= $bokstav;
    }
}

// Skriv ut sidan
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caesarkrypto (4.4)</title>
    </head>
    <body>
        <form method="POST">
            Text: <input type="text" name="text" size=50><br>
            <input type="submit" name="kryptera" value="Kryptera">
            <input type="submit" name="dekryptera" value="Dekryptera">
        </form>
    <?php
        echo $svar;
    ?>
    </body>
</html>