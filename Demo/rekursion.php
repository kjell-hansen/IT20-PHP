<?php
$str = "Tröst"; // Sträng att permutera
$n = mb_strlen($str); 
permutera($str, 0, $n - 1); // Hitta alla kobinationer!

function permutera(string $str,int $start,int $slut): void { 
    if ($start == $slut) {
            echo $str . '<br>';
    } else { 
        for ($i = $start; $i <= $slut; $i++) { 
            $str = bytPlats($str, $start, $i); 
            permutera($str, $start + 1, $slut); 
        }
    } 
} 

function bytPlats(string $a,int $i,int $j): string { 
    // Byt plats på tecken $i och $j!
    $charArray = mb_str_split($a, 1); 
    $temp = $charArray[$i] ; 
    $charArray[$i] = $charArray[$j]; 
    $charArray[$j] = $temp; 
    return implode($charArray); 
}
