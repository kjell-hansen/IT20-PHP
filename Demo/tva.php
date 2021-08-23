<?php
$a=2;

echo "\$a=$a<br>";
change_a();
echo "\$a=$a<br>";
change_a_again();
echo "\$a=$a<br>";


function change_a(){
    $a=4;
}

function change_a_again() {
    global $a;
    $a=8;
}
