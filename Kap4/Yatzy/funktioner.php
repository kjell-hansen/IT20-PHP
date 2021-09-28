<?php

declare (strict_types=1);

/**
 * Sparar undan en cookie med angivet namn
 * @param string $namn
 * @return void
 */
function sparaNamn(string $namn): void {
    // Sätter cookien 'namn' till värdet på inparametern
    setcookie('namn', $namn);

    return;
}

/**
 * Returnerar ett tärningskast med en vanlig tärning
 * @return int - Tärningens värde
 */
function rullaTarning():int {
    $varde= random_int(1, 6);
    
    return $varde;
}