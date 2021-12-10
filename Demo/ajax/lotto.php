<?php
declare(strict_types=1);
$resultat["Lotto"] = slumpaLottorad();
$resultat["ServerTime"]= date("r");

echo json_encode($resultat);

function slumpaLottorad(): string {
    $resultat = array();
    do {
        $i = random_int(1, 40);
        if (!isset($resultat[$i])) {
            $resultat[$i] = $i;
        }
    } while (count($resultat) < 7);

    sort($resultat);
    $svar = implode(",", $resultat);
    return $svar;
}
