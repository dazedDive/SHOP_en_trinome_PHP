<?php
class Autoload
{

    static function register()
    {
            spl_autoload_register(array(__CLASS__, 'autoloader'));
    }
    
    private static function formatLinux($params){
        // valable pour les systèmes de type UNIX (Linux, BSD, MacOS, Solaris...)
        $filePath = $_ENV['db']['root'] . str_replace('\\', '/', $params) . '.php';;
        return $filePath;
    }
    
    static function autoloader($className)
    {
        // valable pour Windows
        // require 'src'.$params.".php";
        
        
        // $classPath = $_ENV['db']['root'] . "$className.php";
        $classPath = Self::formatLinux($className);
        if (file_exists($classPath)) {
            require_once $classPath;
        }
        $toolsPath = lcfirst($className) . ".php";
        if (file_exists($toolsPath)) {
            require_once $toolsPath;
        }
        // spl_autoload_register("autoload");
    }
}
