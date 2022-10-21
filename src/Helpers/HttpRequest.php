<?php

namespace Helpers;

class HttpRequest
{
    public string $method;
    public array $route;
    /**
     * Récupère la méthode (ex : GET, POST, etc ...)
     * et les différentes partie de la route sous forme de tableau
     * (ex : ["product", 1])
     */
    private function __construct()
    {
        $method = [$_SERVER("REQUEST_METHOD")];
        $route = explode('/', $_SERVER("REQUEST_URI"));
        // $result = array_merge($method, $route);
        // echo json_encode($result);
    }
    private static $instance;
    /**
     * Crée une instance de HttpRequest si $instance est null
     * puis retourne cette instance
     */
    public static function instance(): HttpRequest
    {
        if(!isset($instance)) $instance = new HttpRequest;
        return self::$instance;
    }
}
