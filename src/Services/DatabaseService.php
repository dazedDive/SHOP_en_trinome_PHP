<?php namespace Services;

use PDO;
use PDOException;
use Models\ModelList;
use Models\Model;

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
            $pass= $dbConfig['pass'];
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
        $rows = $resp->statment->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getSchema (){
        $schemas = [];
        $sql = "SHOW FULL COLUMNS FROM $this->table " ;
        $resp = $this->query($sql);
        $schemas = $resp->statment->fetchAll(PDO::FETCH_CLASS);
        return $schemas ;
        }

    // public function insertOrUpdate ( array $body ) : ? array
    //     {
    //     //créer un ModelList à partir du body de la requête
    //     $modelList = new ModelList($this->table,$body);
    //     //récupérer en DB les lignes de la table dont l'id est dans $modelList->items
    //     $idToBind = $modelList->idList($this->items[$this->pk]);
    //     $dbs= new DatabaseService($this->table);
    //     $existingRowsList=$dbs->selectWhere("Id_".$this->table."=?", $idToBind) ;
    //     if(count($existingRowsList)==0){
    //         return "faut faire un create";
    //     }else{
             
    //         //créer un ModelList avec les lignes existantes
    //         $existingModelsList = new ModelList($this->table,$existingRowsList);
    //         $existingModelsList;

    //     }
    //     //construire la requête sql et le tableau de valeurs
    //     //pour insérer les lignes qui n'existent pas en DB
    //     //construire la requête sql et le tableau des valeurs
    //     //pour mettre à jour les lignes existantes en DB
    //     //il est possible de ne faire qu'une seule requête
    //     //pour la mise à jour et l'insertion
    //     //INSERT ... ON DUPLICATE KEY UPDATE ...
    //     //exécuter la ou les requête(s)
    //     //renvoyer un tableau contenant toutes les lignes (insérées et mises à jour)
    //     //renvoyer null si le résultat de la ou des requête(s) :
    //     //$this->query($sql, $valuesToBind) vaut false
    //     $sql = "???" ;
    //     $valuesToBind = [ "" , "" , "" ];
    //     $resp = $this -> query ( $sql , $valuesToBind );
    //     if ( $resp -> result ) {
    //     //???
    //     }
    //     return null ;
        
    //     return null ;
    //     }

    public function insertOrUpdate(array $body) : ?array
{
    $modelList = new ModelList($this->table, $body['items']);
    $inClause = trim(str_repeat("?,", count($modelList->items)), ",");
    $existingRowsList = $this->selectWhere("$this->pk IN ($inClause)", $modelList->idList());
    $existingModelList = new ModelList($this->table, $existingRowsList);
    $valuesToBind = [];
    foreach($modelList->items as &$model){
        $existingModel = $existingModelList->findById($model->{$this->pk});
        foreach ( $body['items'] as $item ) {
            if (isset($item[$this->pk]) && $model->{$this->pk} == $item[$this->pk] ) {
                $model = new Model($this->table, array_merge((array)$existingModel, $item));
            }
        }
        $valuesToBind = array_merge($valuesToBind, array_values($model->data()));
    }
    $columns = array_keys(Model::getSchema($this->table));
    $values = "(" . trim(str_repeat("?,", count($columns)), ',') . "),";
    $valuesClause = trim(str_repeat($values, count($body["items"])), ',');
    $columnsClause = implode(",", $columns);
    $fieldsToUpdate = array_diff($columns, array($this->pk, "is_deleted"));
    $updatesClause = "";
    foreach ($fieldsToUpdate as $field) {
        $updatesClause .= "$field = VALUES($field), ";
    }
    $updatesClause = rtrim($updatesClause, ", ");
    $sql = "INSERT INTO $this->table ($columnsClause) VALUES $valuesClause ON DUPLICATE KEY UPDATE $updatesClause";
    $resp = $this->query($sql, $valuesToBind);
    if ($resp->result) {
        $rows = $this->selectWhere("$this->pk IN ($inClause)", $modelList->idList());
        return $rows;
    }
    return null;
}


}