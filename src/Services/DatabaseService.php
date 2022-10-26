<?php namespace Services;

use PDO;
use PDOException;

class DatabaseService{
    public string $table;
    public string $pk;

    public function __construct(string $table = "")
    {
        $this->table = $table;
        $this->pk='Id_'. $this->table;

    }
    private static ? PDO $connection = null ;
    private function connect () : PDO {

    ///////////////////////////CONNECT TO DB////////////////////////////////
        if(self::$connection == null) {
            $dbConfig = $_ENV['db'];
            $host = $dbConfig['host'];
            $port = $dbConfig['port'];
            $dbname= $dbConfig['dbName'];
            $user=$dbConfig['user']; 
            $pass="";
            $dsn="mysql:host=$host;port=$port;dbname=$dbname"; 
           try{
            $dbConnection = new PDO(
                $dsn,
                $user,
                $pass,
                array(
                    PDO ::ATTR_ERRMODE => PDO ::ERRMODE_EXCEPTION,
                    PDO ::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ,
                )
                );

           }
           catch(PDOException $e ){
                die("Error of Database Connexion $e -> getMessage ()");

           }
           self :: $connection = $dbConnection ;
           
        }
        return self::$connection;
    }

    ///////////////////////////////QUERY//////////////////////////////
    public function query ( string $sql , array $params = []) : object{
    $statment = $this -> connect ()-> prepare ( $sql );
    $result = $statment -> execute ( $params );
    return ( object )[ 'result' => $result , 'statment' => $statment ];
    }

    //////////////////////////////GETTABLES////////////////////
    /**
    * Retourne la liste des tables en base de données sous forme de tableau
    */

    public static function getTables () : array
    {
        $dbs=new DatabaseService();
        $table="information_schema.tables";
        $tableToSearch=$_ENV['db']['dbName'];
        $sql = "SELECT table_name FROM $table WHERE table_schema = ?";
        $resp = $dbs->query($sql, [$tableToSearch]);
        $tables = $resp->statment->fetchAll(PDO::FETCH_COLUMN);
        return $tables;
    }

    /**
    * Retourne les lignes correspondant à la condition where
    */
    public function selectWhere(string $where = "1", array $bind = []) : array
    {
        $sql ="SELECT * FROM $this->table WHERE $where";
        $resp = $this->query($sql, $bind);
        $rows = $resp->statment->fetchAll(PDO::FETCH_CLASS);
        return $rows;
    }

    public function getSchema (){
        $schemas = [];
        $sql = "SHOW FULL COLUMNS FROM $this->table " ;
        $resp = $this->query($sql);
        $schemas = $resp->statment->fetchAll(PDO::FETCH_CLASS);
        return $schemas ;
        }
}