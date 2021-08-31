<?php
    $aktuelltTal=rand(1,10);
    
    if(isset($_POST["gissning"])) {
        $foregaendeTal=$_POST["foregaendeTal"];
        $gissning=(int) $_POST["gissning"];
        $svar="Föregående tal var... $foregaendeTal";
        $antalGissningar=$_POST["antalGissningar"];
        if (($aktuelltTal<=>$foregaendeTal)===$gissning) {
            $antalGissningar++;
            $svar.="<br>RÄTT!!!!!!";
            $svar.="<br>Du har gissat $antalGissningar gånger";            
        } else {
            $antalGissningar=0;
            $svar.="<br>Du gissade tyvärr fel :(";
        }
    } else {
        $svar="";
        $antalGissningar=0;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gissa högre eller lägre!</title>
    </head>
    <body>
        <p>Aktuellt tal är... <?= $aktuelltTal; ?></p>
        <form method="POST">
            Jag tror nästa tal blir: <select name="gissning" size="1">
                <option value=-1>Lägre</option>
                <option value=0>Samma</option>
                <option value=1>Högre</option>
                </select>
            <br>
            <input type="submit" value="Skicka">
            <input type="hidden" name="foregaendeTal" value="<?= $aktuelltTal; ?>">
            <input type="hidden" name="antalGissningar" value="<?= $antalGissningar; ?>">
        </form>
<?php
    echo $svar;
?>        
    </body>
</html>