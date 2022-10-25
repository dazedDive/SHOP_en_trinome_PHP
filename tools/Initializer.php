<?php

namespace Tools;


use Services\DatabaseService;
use Helpers\HttpRequest;
use Exception;

class Initializer
{
    public function __construct()
    {
    }

    /**
     * Génère la classe Schemas\Table (crée le fichier)
     * qui liste toutes les tables en base de données
     * sous forme de constante
     * Renvoie la liste des tables sous forme de tableau
     * Si $isForce vaut false et que la classe existe déjà, elle n'est pas réécrite
     * Si $isForce vaut true, la classe est supprimée (si elle existe) et réécrite
     */
    private static function writeTableFile(bool $isForce = false): array
    {
        $tables = DatabaseService::getTables();
        $tableFile = "src/Schemas/Table.php";
        if (file_exists($tableFile) && $isForce) {
            //Supprimer le fichier s’il existe
            try {
                unlink($tableFile);
            }
            //Si la suppression ne fonctionne pas déclenche une Exception
            catch (Exception $e) {
                echo "Exception levée: " . $e->getMessage();
            }
        }

        if (!file_exists($tableFile)) {
            //???
            //Créer le fichier (voir exemple ci dessous)
            try {

                $row = "<?php namespace Schemas; class Table{ ";
                $file = fopen($tableFile, 'a');
                fwrite($file, $row);


                foreach ($tables as $nameFile) {
                    $row = "const " . ucfirst($nameFile) . " = " . "'" . lcfirst($nameFile) . "'" . ";";
                    $file = fopen($tableFile, 'a');
                    fwrite($file, $row);
                }
                $file = fopen($tableFile, 'a');
                fwrite($file, '}');
                fclose($file);
            }
            //Si l’écriture ne fonctionne pas déclenche une Exception
            catch (Exception $e) {
                echo "Exception levée: " . $e->getMessage();
            }
        }
        return $tables;
    }
    
    /**
     * Exécute la méthode writeTableFile
     * Renvoie true si l'exécution s'est bien passée, false sinon
     */
    public static function start(HttpRequest $request): bool
    {
        $isForce = count($request->route) > 1 && $request->route[1] == 'force';
        try {
            $init = new Initializer;
            $init->writeTableFile(true);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
