<?php

    // Filnamn
    $fil=__FILE__;
    
    // Läs in innehållet till en variabel
    $filinnehall=file_get_contents($fil);
    
    // Gör om "farliga" tecken
    $safe=htmlentities($filinnehall);
    
    // Skriv ut med bevarande av "white space"
    echo "<pre>$safe</pre>";