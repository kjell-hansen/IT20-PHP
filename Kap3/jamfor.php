<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jämför inmatade värden</title>
    </head>
    <h1>Jämför värden</h1>
    <form method="POST">
        Värde 1: <input type="text" name="varde1"><br>
        Värde 2: <input type="text" name="varde2"><br>
        <input type="submit" value="Skicka">
    </form>
<?php
    if(isset($_POST['varde1'])) {
        $varde1=$_POST['varde1'];
        $varde2=$_POST['varde2'];
        echo "$varde1<br>$varde2";
?>
        <table>
            <tr>
                <th>Operator</th>
                <th>Beräkning</th>
                <th>Resultat</th>
                <th>Förklaring</th>
            </tr>
            <tr>
                <td>==</td>
                <td><?= $varde1; ?>==<?= $varde2; ?></td>
                <td><?php $varde1==$varde2 ? print "true" : print "false"; ?></td>
                <td><?php 
                    if($varde1==$varde2) {
                        $text= "$varde1==$varde2 är sant";
                    } else {
                        $text= "$varde1==$varde2 är inte sant";
                    }
                    echo $text;
                    ?>
                 </td>
            </tr>
            <tr>
                <td><=></td>
                <td><?= $varde1; ?><=><?= $varde2; ?></td>
                <td><?= ($varde1<=>$varde2); ?></td>
                <td><?php 
                    switch($varde1<=>$varde2) {
                            case -1:
                                echo "$varde1 < $varde2";
                                break;
                            case 0:
                                echo "$varde1 = $varde2";
                                break;
                            case 1:
                                echo "$varde1 > $varde2";
                                break;
                    }
                    ?>
                 </td>
            </tr>
        </table>
<?php        
    }
?>    
</html>