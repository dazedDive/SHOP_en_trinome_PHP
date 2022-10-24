<?php
require_once 'autoload.php';
Autoload::register();

header("Access-Control-Allow-Origin: http://localhost:3000");

$env = 'dev';
$_ENV = json_decode(file_get_contents("src/configs/" . $env . ".config.json"), true);
$_ENV['env'] = $env;

use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Helpers\HttpResponse;
use Services\DatabaseService;

$request = HttpRequest::instance();
$tables = DatabaseService::getTables();
if (empty($request->route) || !in_array($request->route[0], $tables)) {
    HttpResponse::exit();
}
$controller = new DatabaseController($request);
$result = $controller->execute();
HttpResponse::send(["data" => $result]);

?>

