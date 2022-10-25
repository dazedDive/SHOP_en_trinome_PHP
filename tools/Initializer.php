<?php

use Services\DatabaseService;

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
            try{
                unlink($tableFile);
            }
            //Si la suppression ne fonctionne pas déclenche une Exception
            catch(Exception $e){
                echo "Exception levée: " . $e->getMessage();     
            }
        }


        if (!file_exists($tableFile)) {
            //???
            //Créer le fichier (voir exemple ci dessous)
            try{

                



                $file = fopen($tableFile, 'a');
                fwrite($file, 'test');
                fclose($file);
            }
            //Si l’écriture ne fonctionne pas déclenche une Exception
            catch(Exception $e){
                echo "Exception levée: " . $e->getMessage();     
            }

        }
        return $tables;
    }
}
