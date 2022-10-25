<?php
require_once 'autoload.php';
Autoload::register();

// require_once 'tools/Initializer.php';

header("Access-Control-Allow-Origin: http://localhost:3000");

use Tools\Initializer;
use Helpers\HttpResponse;
use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Services\DatabaseService;

// $env = 'dev';
// $_ENV = json_decode(file_get_contents("src/configs/" . $env . ".config.json"), true);
// $_ENV['env'] = $env;

if (
    $_ENV['env'] == 'dev' && !empty($request->route) && $request->route[0] ==
    'init'
) {
    if (Initializer::start($request)) {
        HttpResponse::send(["message" => "Api Initialized"]);
    }
    HttpResponse::send(["message" => "Api Not Initialized, try again ..."]);
}
//Standard routes

// use Controllers\DatabaseController;
if (!empty($request->route)) {
    $const = strtoupper($request->route[0]);
    $key = "Schemas\Table::$const";
    if (!defined($key)) {
        HttpResponse::exit(404);
    }
} else {
    HttpResponse::exit(404);
}
$controller = new DatabaseController($request);
$result = $controller->execute();
if ($result) {
    HttpResponse::send(["data" => $result], 200);
}


// $init = new Initializer;
// $init->writeTableFile(true);

$request = HttpRequest::instance();
$tables = DatabaseService::getTables();
if (empty($request->route) || !in_array($request->route[0], $tables)) {
    HttpResponse::exit();
}
$controller = new DatabaseController($request);
$result = $controller->execute();
HttpResponse::send(["data" => $result]);
