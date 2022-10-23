<?php
 class Autoload {

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoloader'));
    }

    static function autoloader($params){
        // valable pour Windows
        // require 'src'.$params.".php";
        
        // valable pour les systèmes de type UNIX (Linux, BSD, MacOS, Solaris...)
        $file = 'src/'.str_replace('\\', '/', $params ) .'.php';
        require $file;

    }

}
?>