<?php

function skickaSvar(stdClass $info, int $svarsKod):void {    
    header(hamtaHeader($svarsKod));
    echo json_encode($info, JSON_UNESCAPED_UNICODE);
    exit;
}

function hamtaHeader(int $svarsKod):string {
    $retur=";Content-type:application/json;charset=utf-8";
    switch ($svarsKod) {
        case 200:
            $retur ="200 OK" . $retur;
            break;
        case 400:
            $retur ="400 Bad Request" . $retur;
            break;
        case 401:
            $retur ="401 Unauthorized" . $retur;
            break;
        default:
            $retur ="500 Invalid Header" . $retur;
            break;
    }
    
    $retur="HTTP/1.1 " .$retur;
    
    return $retur;
}