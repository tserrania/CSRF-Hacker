<?php

$requestedPage=$_SERVER["REDIRECT_URL"];
$router=str_replace('/CSRF-Attack/','',$requestedPage);

if($router[-1]=='/'){
    $router=substr($router, 0, -1);
}

if($router == ''){
    include 'bad-file.php';
    exit;
} elseif($router == 'jquery'){
    include 'jquery.min.js';
    exit;
}else{
    echo "error 404";
    include '404.php';
    exit;
}