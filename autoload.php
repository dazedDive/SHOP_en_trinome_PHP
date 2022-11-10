<?php
class autoload
{

    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoloader'));
    }

    static function autoloader($className)
    {
        // valable pour les systèmes de type UNIX (Linux, BSD, MacOS, Solaris...)
        $file = 'src/' . str_replace('\\', '/', $className) . '.php';
        if (file_exists($file))
            require_once $file;

         $classPath = $_ENV['root'] . "$className.php";
         if (file_exists($classPath)) {
             require_once $classPath;
         }
         $toolsPath = lcfirst($className) . ".php";
         if (file_exists($toolsPath)) {
             require_once $toolsPath;
         }
    }
}
 