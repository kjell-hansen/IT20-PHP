<?php
declare (strict_types=1);

$menu=new stdClass();
$menu->breakfast_menu=new stdClass();

$food1=new stdClass();
$food1->name="Belgian waffles";
$food1->price=5.95;
$food1->description="Two of our famous Belgian Waffles with plenty of maple sirup";
$food1->energy=new stdClass();
$food1->energy->measure="kcal";
$food1->energy->value=650;

$food2=new stdClass();
$food2->name="Strawberry Belgian waffles";
$food2->price=7.95;
$food2->description="Light Belgian Waffles with strawberries and whipped cream";
$food2->energy=new stdClass();
$food2->energy->measure="kJ";
$food2->energy->value=200;

$food=[$food1, $food2];
$menu->breakfast_menu->food=$food;

header("Content-type:application/json;charset=UTF-8");
echo json_encode($menu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);