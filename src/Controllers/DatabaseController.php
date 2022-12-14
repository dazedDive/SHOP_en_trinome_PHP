<?php namespace Controllers;
    use Services\DatabaseService;
    use Helpers\HttpRequest;
    class DatabaseController
    {
        private string $table;
        private string $pk;
        private ?string $id;
        private array $body;
        private string $action;
        public function __construct(HttpRequest $request)
        {
                        
            
            $this->table=$request->route[0];
           
            if(isset($request->route[1])){
            $this->id=$request->route[1];
            }
            
            
            if(isset($this->table)){
                $this->pk = "Id_".$this->table;
            }

            // $request_body = file_get_contents('php://input');
            $this->body = [];
                  
            $this->action=$request->method;
            
        }
        
        public function execute() : ?array
        {
            if($this->action=="GET"){
                return $this->get();
            }
           
            
        }
        /**
        * Action exécutée lors d'un GET
        * Retourne le résultat du selectWhere de DatabaseService
        * soit sous forme d'un tableau contenant toutes les lignes (si pas d'id)
        * soit sous forme du tableau associatif correspondant à une ligne (si id)
        */
        private function get() : ?array
        {
           $dbs= new DatabaseService($this->table);
           if (isset($this->id)){
            $result= $dbs->selectWhere($this->pk."=?",[$this->id]);
            
           }else{
            $result=$dbs->selectWhere("is_deleted=?",[0]);
           } 
           return $result;
        }

    }