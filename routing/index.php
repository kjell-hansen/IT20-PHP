<?php

$request = $_SERVER['REQUEST_URI'];

switch (substr($request,8)) {
    case '/' :
        require __DIR__ . '/views/main.php';
        break;
    case '' :
        require __DIR__ . '/views/main.php';
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}