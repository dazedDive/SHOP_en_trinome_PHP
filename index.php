<?php

use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Helpers\HttpResponse;
use Services\DatabaseService;

    header("Access-Control-Allow-Origin: http://localhost:3000");
    $env = 'dev';/////a changer pour modifier la config general/////////
    $_ENV = json_decode(file_get_contents("configs/" . $env . ".config.json"), true);
    $_ENV['env'] = $env;
    require_once 'autoloader.php';
    Autoloader::register();

    
    // $test = HttpRequest::instance();
    // HttpResponse::send(["method"=>$test->method,"route"=>$test->route]);

    $tables = DatabaseService :: getTables ();
    if(count($tables)==0){
        HttpResponse::exit();
    }else{
        HttpResponse::send($tables,200);
    }
    
?>