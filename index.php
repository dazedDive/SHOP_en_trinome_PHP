<?php

use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Helpers\HttpResponse;

    header("Access-Control-Allow-Origin: http://localhost:3000");
    
    require_once 'autoloader.php';
    Autoloader::register();
    
    $test = HttpRequest::instance();
    HttpResponse::send(["method"=>$test->method,"route"=>$test->route]);


    
    
?>