<?php

use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Helpers\HttpResponse;
use Services\DatabaseService;
use Tools\Initializer;

    header("Access-Control-Allow-Origin: http://localhost:3000");
    $env = 'dev';/////a changer pour modifier la config general/////////
    $_ENV = json_decode(file_get_contents("src/configs/" . $env . ".config.json"), true);
    $_ENV['env'] = $env;
    require_once 'src/autoloader.php';
    Autoloader::register();

    
    // $test = HttpRequest::instance();
    // HttpResponse::send(["method"=>$test->method,"route"=>$test->route]);
    $request = HttpRequest::instance();
    $tables = DatabaseService :: getTables ();
    
    if(empty($request->route) || !in_array($request->route[0], $tables)){
    HttpResponse::exit();
    }
    
    
    $controller = new DatabaseController($request);
    $result = $controller->execute();
    // HttpResponse::send(["data"=>$result]);

    require_once 'Tools/Initializer.php';
    Initializer::writeTableFile();

?>