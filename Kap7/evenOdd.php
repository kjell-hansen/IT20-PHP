<?php
declare (strict_types=1);

if(isset($_GET['odd'])) {
    $resultat=new stdClass();
    $resultat->numbers=[1,3,5,7,9];
}elseif (isset($_GET['even'])) {
    $resultat=new stdClass();
    $resultat->numbers=[2,4,6,8];
}elseif (isset($_GET['all'])) {
    $resultat=new stdClass();
    $resultat->numbers=[1,2,3,4,5,6,7,8,9];
} else {
    header("HTTP/1.1 400 Bad request; Content-type:application/json ; charset=UTF-8");
    echo json_encode(["Fel" => "Ange parameter 'odd' för udda tal, 'even' för jämna tal och 'all' för alla tal"]);
    exit();
}
header("Content-type:application/json ; charset=UTF-8");
echo json_encode($resultat, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
