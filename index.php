<?php
use Controllers\DatabaseController;
use Helpers\HttpRequest;
use Helpers\HttpResponse;
use Models\Model;
use Models\ModelList;
use Schemas\Table;
use Services\DatabaseService;
use Tools\Initializer;
require_once 'autoload.php';

// require_once 'vendor/autoload.php';
// use Helpers\HttpRequest;
// use Helpers\HttpResponse;
// use Services\DatabaseService;
// use Tools\Initializer;
// use Controllers\DatabaseController;

autoload::register();

header("Access-Control-Allow-Origin: http://localhost:3000");
$env = 'dev';/////a changer pour modifier la config general/////////
$_ENV = json_decode(file_get_contents("src/configs/" . $env . ".config.json"), true);
$_ENV['env'] = $env;
    
    // $test = HttpRequest::instance();
    // HttpResponse::send(["method"=>$test->method,"route"=>$test->route]);
    $request = HttpRequest::instance();
    $tables = DatabaseService :: getTables ();

    if($_ENV['env']=='dev' && !empty($request->route) && $request->route[0]=='init'){
        if(Initializer::start($request)){
            HttpResponse::send(["message"=>"API Initialized Ok"]);
        }
    HttpResponse::send(["message"=>"API Not Initialized Try Again..."]);
    }

   $test1 = ["Id_drawing"=>"1gieh2f99b60heb8","name"=>"un new dessin"];
   $test2 = ["name"=>"un autre dessin"];
   
   $dbs= new DatabaseService('drawing');
   $testdata = $dbs->insertOrUpdate([$test1]);
   $testdata;

    //STD ROUTES////////
    if(!empty($request->route)){
    $const =  strtoupper($request->route[0]);
    $key = "Schemas\Table::$const";
    if(!defined($key)){
        HttpResponse::exit(404);
        }
    }
    else {HttpResponse::exit(404);
    }   
    
    
    $controller = new DatabaseController($request);
    $result = $controller->execute();
    if($result){
    HttpResponse::send(["data"=>$result,200]);
    }
    
    
    

?>