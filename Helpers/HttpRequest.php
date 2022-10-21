<?php namespace Helpers;

class HttpRequest {
    public string $method;
    public array $route;
    
    private function __construct()
    {

        $this->method = $_SERVER['REQUEST_METHOD'];
        $request = trim($_SERVER['REQUEST_URI'],"/");
        $request = filter_var($request , FILTER_SANITIZE_URL);
        
        $this->route=explode("/",$request);

    }

    private static $instance;
    public static function instance (): HttpRequest
    {
        if(is_null(self::$instance)) {
            self::$instance = new HttpRequest();  
          }
        return self::$instance;

    }
}