<?php

if (isset($_GET['svar']) && $_GET['svar']=="rätt") {
    echo 'Det här svaret var rätt';
} else {
    echo "Det här händer om det inte blev rätt";
}
