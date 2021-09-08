<?php
declare (strict_types=1);
// Ange ett standardvärde
$artal=date("Y");

// Kontrollera om vi fått någon indata
if(isset($_GET['artal'])) {
    // Ta hand om indata om det är ett heltal
    $artal=filter_input(INPUT_GET, 'artal', FILTER_VALIDATE_INT);
    // Sätt årets år om talet är utanför angivna gränser
    if ($artal>2050 || $artal<1988) {
        $artal=date("Y");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tjejvasan (4.23)</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <form method="GET">
            Ange år:<input type="number" value="<?= $artal; ?>" name="artal" max=2050 min=1988><br>
            <input type="submit" value="Skicka!">
        </form>
        <p>Tjejvasan genomförs de närmaste 5 åren följande datum:<br>
        <?php
            for($i=0;$i<5;$i++) {
                echo $artal+$i . " den " . tjejvasan($artal+$i) . "<br>";
            }
        ?>
        </p>
    </body>
</html>
<?php
// Funktion för att beräkna datum för tjejvasan
// Sträng med datum returneras 
function tjejvasan(int $ar):string {
    // Hitta datum för vanliga Vasaloppet
    $datum=strtotime("First Sunday of March $ar");
    // Tjejvasan går lördagen veckan före vanliga Vasaloppet
    $datum=strtotime("-8 days", $datum);
    
    // Returnera det funna datumet
    return date("Y-m-d", $datum);
}