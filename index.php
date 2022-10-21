<?php
require_once 'autoload.php';  
Autoload::register();

$env = 'dev';
$_ENV = json_decode(file_get_contents("src/configs/".$env.".config.json"), true);
$_ENV['env'] = $env;

use controllers\ArtistController;
use controllers\CollectionController;
use controllers\CartController;
use controllers\HomeController;
use controllers\TopController;
use controllers\AdminController;
use controllers\DatabaseController;
use Helpers\HttpRequest;
use Helpers\HttpResponse;

// $request = HttpRequest::instance();
// HttpResponse::send(["method"=>"$request->method", "route"=> $request->route]);

// $top = new TopController();
// $admin = new AdminController();
// $cart = new CartController();
// $home = new HomeController();
// $artist = new ArtistController();
// $database = new DatabaseController();
//     $data = "OK";
//     HttpResponse::send(["data"=>$data]);



    header("Access-Control-Allow-Origin: http://localhost:3000");

    $request = trim($_SERVER['REQUEST_URI'],"/");
    $request = filter_var($request , FILTER_SANITIZE_URL);
    $request = explode("/",$request);
    $route = array_shift($request);
       
    $controller = ucfirst($route);
    $controllerName = $controller.".controller";
    
    $method = $_SERVER['REQUEST_METHOD'];
    


    
?>