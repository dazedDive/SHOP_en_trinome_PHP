<?php

namespace Models;

use Services\DatabaseService;

class Model
{
    public string $table;
    public string $pk;
    public array $schema;

    public function __construct(string $table, array $json)
    {
        $this->table = $table;
        $this->pk = "Id_" . $this->table;
        $this->schema = self::getSchema($this->table);
        if (!isset($json[$this->pk])) {
            $json[$this->pk] = $this->nextGuid();
        }
        foreach ($this->schema as $k => $v) {
            if (isset($json[$k])) {
                $this->$k = $json[$k];
            } elseif (
                $this->schema[$k]['nullable'] == 1 &&
                $this->schema[$k]['default'] == ''
            ) {
                $this->$k = null;
            } else //valeur par défaut
            {
                $this->$k = $this->schema[$k]['default'];
            }
        }
    }
    /**
     * Renvoie le schéma (colonnes de la table) défini dans la classe Schemas
     * correspondant à $table sous forme de tableau associatif
     * (classe Schemas généré au sprint 4)
     */
    public function getSchema(string $table): array
    {
        $schemaName = "Schemas\\" . ucfirst($table);
        return $schemaName::COLUMNS;
    }

    /**
     * Crée un identifiant unique de $length caractères (par defaut)
     * L'idée est de se servir de la fonction microtime() pour récupérer le timestamp
     * Puis de le convertir en base 32 [a-z][0-9] ce qui vous donnera 9 caractères
     * Completer ensuite en générant autant de caractère aléatoire (base 32)
     * que nécessaire pour obtenir la $length souhaitée (16 par defaut)
     */
    public function nextGuid(int $length = 16): string
    {
        $guid = base_convert(microtime(), 9, 32);
        for ($i = strlen($guid); $i < $length; $i++) {
            $randomChar = base_convert(rand(0, 31), 9, 32);
            $guid .= $randomChar;
        }

        return $guid;
    }
    /**
     * Renvoie la liste des données sous forme de tableau associatif
     * (Récupérez les colonnes grâce au schéma)
     * exemple : une instance de Model correspondant à la table role
     * a pour variables :
     * table, pk, schema, id_role, title, weight et is_deleted
     * seules les variables id_role, title, weight et is_deleted
     * existent en base de données
     * la méthode data les renvoie sous forme de tableau associatif
     * table, pk et schema ne sont pas renvoyée
     */
    public function data(): array
    {
        $data = (array) clone $this;
        foreach ($data as  $key=>$value) {
            if (!isset($this->schema[$key])) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
