<?php

for($i=1;$i<=6;$i++) {
    $tarning[$i]=0;
}

for($i=1;$i<=5;$i++) {
    $tarning[rand(1,6)]++;
}

foreach($tarning as $varde => $antal) {
    if($antal>0) {
        echo "Du fick $antal $varde:or<br>";
    }
}