<?php
require_once 'autoload.php';
Autoload::register();

header("Access-Control-Allow-Origin: http://localhost:3000");

use Tools\Initializer;
use Helpers\HttpResponse;
use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Services\DatabaseService;
use Schemas\Table;

$env = 'dev';
$_ENV = json_decode(file_get_contents("src/configs/" . $env . ".config.json"), true);
$_ENV['env'] = $env;

// Test de fonctionalité : Génération de Table.php
// $schema = new DatabaseService;
// echo $schema->getSchema();

// test
// $init = new Initializer;
// $init->writeSchemasFiles($tables, true);


$request = HttpRequest::instance();

if (
    $_ENV['env'] == 'dev' && !empty($request->route) && $request->route[0] ==
    'init'
    ) {
        if (Initializer::start($request)) {
            HttpResponse::send(["message" => "Api Initialized"]);
        }
        HttpResponse::send(["message" => "Api Not Initialized, try again ..."]);
    }
    
    // test
    $init = new Initializer;
    $init->writeTableFile(true);
    
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
    
    
    $tables = DatabaseService::getTables();
    if (empty($request->route) || !in_array($request->route[0], $tables)) {
        HttpResponse::exit();
    }
    $controller = new DatabaseController($request);
    $result = $controller->execute();
    HttpResponse::send(["data" => $result]);
