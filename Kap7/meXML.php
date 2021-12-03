<?php
declare (strict_types=1);

// Skapa Trädstrukturen
$person=new DOMDocument('1.0', 'UTF-8');
// Formattera det som skickas på ett snyggt sätt
$person->formatOutput=true;

// Skapa ett root-element
$me=$person->createElement('jag');
// Lägg till det i trädet
$person->appendChild($me);

// Lägg till barn-noder
$me->appendChild($person->createElement("namn", "Kjell"));
$me->appendChild($person->createElement("fodd", "18 januari"));

// Skriv ut header-info
header("Content-type:application/xml; charset=UTF-8");
// Skriv ut XML-trädet
echo $person->saveXML();
