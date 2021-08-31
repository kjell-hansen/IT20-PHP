<!DOCTYPE html>
<html>
    <head>
        <title>3.4 formatera tal</title>
        <meta charset='UTF-8'>
        <style>
            p {
                margin:0;
            }
            .blue {
                color:blue;
            }
            .fat {
                font-weight: bold;
            }
            .kursiv {
                font-style : italic;
            }
        </style>
    </head>
    <body>
<?php
for ($i=1;$i<=100;$i++) {
    $class="";
    if ($i%2===0) {
        $class.="blue ";
    }
    if ($i%5===0) {
        $class.="fat ";
    }
    if ($i%7===0) {
        $class.="kursiv ";
    }
    echo "<span class='$class'>$i </span>";
    if ($i%10===0) {
        echo "<br>";
    }
    
}

?>
    </body>
</html>