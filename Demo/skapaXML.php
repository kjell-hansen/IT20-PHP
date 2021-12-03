<?php
declare (strict_types=1);

$menu=new DOMDocument('1.0', 'UTF-8');
$menu->formatOutput=true;
$bm=$menu->createElement('Breakfastmenu');
$menu->appendChild($bm);

$food=$menu->createElement('food');
$food->appendChild($menu->createElement('name', "Belgian waffles"));
$food->appendChild($menu->createElement('price', "$5.95"));
$food->appendChild($menu->createElement('description', 
        "Two of our famous Belgian Waffles with plenty of maple sirup"));
$energy=$menu->createElement('energy', '650');
$energy->setAttribute("measure", "kcal");
$food->appendChild($energy);
$bm->appendChild($food);

$food=$menu->createElement('food');
$food->appendChild($menu->createElement('name', "Strawberry Belgian waffles"));
$food->appendChild($menu->createElement('price', "$7.95"));
$food->appendChild($menu->createElement('description', 
        "Light Belgian Waffles with strawberries and whipped cream"));
$energy=$menu->createElement('energy', '200');
$energy->setAttribute("measure", "kJ");
$food->appendChild($energy);
$bm->appendChild($food);

header("Content-type:application/xml; charset=UTF-8");
echo $menu->saveXML();