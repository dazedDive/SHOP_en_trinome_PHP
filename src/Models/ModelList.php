<?php

namespace Models;

use Helpers\HttpResponse;

class ModelList
{

    public string $table;
    public string $pk;
    public array $items; //liste des instances de la classe Model
    public function __construct(string $table, array $list)
    {
        $this->table = $table;
        $this->schema = self::getSchema($table);
        $this->pk = "Id_" . $this->table;
        $this->items = [];
        foreach ($list as $json) {
            $item = new Model($this->table, $json);
            array_push($this->items, $item);
        }
    }
    public static function getSchema($table): array
    {
        $schemaName = "Schemas\\" . ucfirst($table);
        return $schemaName::COLUMNS;
    }
    /**
     * Même principe que pour Model mais sur une liste ($this->items)
     */
    public function data () : array
    {
        $result = array_map(function($item){
            return $item->data();
        }, $this->items);     
        return $result;
    }
    /**
    * Renvoie la liste des id contenus dans $this->items
    */
    public function idList ( $key = null ) : array
    {
    if (! isset ( $key )) {
    $key = $this->pk ;
        }
    $idlist=[];
    foreach($this->items as $item){
        $id=$item->$key;
        array_push($idlist,$id);
    }
    return $idlist;
    }
    /**
    * Renvoie l'instance contenue dans $this->items correspondant à $id
    */
    public function findById ( $id ) : ? Model
    {   
            foreach($this->items as $item){
            $pk=$this->pk;
            if ($pk == $id){
                return $item;
            }else{
                return null;
            }
        }
    }
   
}
