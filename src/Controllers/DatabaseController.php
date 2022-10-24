<?php

namespace Controllers;

use Helpers\HttpRequest;
use Helpers\HttpResponse;
use Services\DatabaseService;

class DatabaseController
{
    private string $table;
    private string $pk;
    private ?string $id;
    private array $body;
    private string $action;

    public function __construct(HttpRequest $request)
    {
        $this->table = $request->route[0];

        if (isset($this->table)) $this->pk = "Id_" . $this->table;

        if (isset($id)) $this->id = $id;

        $this->body = [];
        // $this->body = http_response_code();

        $this->action = $request->method;
    }

    /**
     * Retourne le résultat de la méthode ($action) exécutée
     */
    public function execute(): ?array
    {
        if ($this->action == "GET") 
        return $rows = $this->action=$this->get($this->id);
        
    }

    private function get(): ?array
    {
        // déterminer si l'URL contient un id
        $db = new DatabaseService($this->table);
        $isId = $_GET['id'] ? true : false;

        /**
         * Action exécutée lors d'un GET
         * Retourne le résultat du selectWhere de DatabaseService
         * soit sous forme d'un tableau contenant toutes le lignes (si pas d'id)
         * soit sous forme du tableau associatif correspondant à une ligne (si id)
         */
        if ($isId) {
            // retourner un tableau associatif correspondant à la ligne
            $getArray = $db->selectWhere($this->pk . "=", [$this->id]);
        } else {
            // retourner un tableau contenant toutes les lignes
            $getArray = $db->selectWhere("is_deleted=", [0]);
        }
        return $getArray;
    }
}
