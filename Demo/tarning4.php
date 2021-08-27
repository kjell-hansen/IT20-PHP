<?php
$antal=0;
for ($i=1;$i<=6;$i++) {
    $tarning[$i]=0;
}

do {
    $antal++;
    $tarning[rand(1,6)]++;
    for($i=1;$i<=6;$i++){
        if($tarning[$i]==0) {
            continue 2; // Avbryt och fortsätt yttre loopen
        }
    }
    if($i==7) {
        break;
    }
}while (true);

echo "Du behövde $antal slag för att få alla värden.";