<?php
$dbDSN="mysql:dbname=accesskopia;host=127.0.0.1;port=3306;charset=utf8";
$dbUser="root";
$dbPassword="";

try {
    $db=new PDO($dbDSN, $dbUser, $dbPassword);
} catch (PDOException $ex) {
    var_dump($ex);
    exit();
}
 $medlem=-1;
 if(isset($_POST['skicka'])) {
     $medlem= filter_input(INPUT_POST, 'medlem', FILTER_VALIDATE_INT);
 }
?>
<html>
    <head>
        <title>Båtar för medlem</title>
        <meta charset="utf8">
    </head>
    <body>
        <h1>Båtar för vald medlem</h1>
        <form method="POST">
            Välj medlem: <?= medlemsDropDown($db, $medlem); ?><br>
            <input type="submit" name="skicka" value="Skicka!">
        </form>
        <hr>
        <table>
            <?= batLista($db, $medlem); ?>
        </table>
    </body>
</html>
<?php 
function medlemsDropDown(PDO $db, $medlem):string {
    $sql="SELECT medlemsnr, fornamn, efternamn FROM medlemmar ORDER BY fornamn";
    // Exekvera SQL och hämta resultatet
    $stmt=$db->query($sql);
    $result=$stmt->fetchAll();
    
    $select="<select name='medlem'>";
    if($medlem===-1) {
        $select .= "<option>Välj medlem</option>";
    }
    foreach ($result as $row) {
        if($row['medlemsnr']===$medlem) {
            $select .="<option value='$row[medlemsnr]' selected>$row[fornamn] $row[efternamn]</option>";
        } else {
            $select .="<option value='$row[medlemsnr]'>$row[fornamn] $row[efternamn]</option>";
                    }
    }
    $select .="</select>";
    
    return $select;
}
function batLista(PDO $db, $medlem):string {
    
}