<?php

use controllers\ArtistController;
use controllers\CollectionController;

    header("Access-Control-Allow-Origin: http://localhost:3000");

    $request = trim($_SERVER['REQUEST_URI'],"/");
    $request = filter_var($request , FILTER_SANITIZE_URL);
    $request = explode("/",$request);
    $route = array_shift($request);
       
    $controller = ucfirst($route);
    $controllerName = $controller."Controller";
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    
    require_once 'autoloader.php';
    Autoloader::register();
    $test = new $controllerName($route);
    $test2 = new ArtistController();
?>