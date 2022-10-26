<?php namespace Tools;

use Exception;
use Helpers\HttpRequest;
use Services\DatabaseService;

class Initializer{
    /**
* Génère la classe Schemas\Table (crée le fichier)
* qui liste toutes les tables en base de données
* sous forme de constante
* Renvoie la liste des tables sous forme de tableau
* Si $isForce vaut false et que la classe existe déjà, elle n'est pas réécrite
* Si $isForce vaut true, la classe est supprimée (si elle existe) et réécrite
*/
public static function writeTableFile(bool $isForce = false) : array
{

$tables = DatabaseService::getTables();
$tableFile = "src/Schemas/Table.php";
$header = "<?php namespace Schemas; \n \n class Table{ \n";
foreach($tables as $k=>$v){
   $tables[$k] = "\n CONST " . strtoupper($v) ."='".$v."';";
}
$footer = "\n } \n ?>";


if(file_exists($tableFile) && $isForce){
    try{
    unlink($tableFile);
    } catch (Exception $e) {
        var_dump($e);
    }
  }
if(!file_exists($tableFile)){
    try{
        file_put_contents($tableFile,$header);
        file_put_contents($tableFile,$tables,FILE_APPEND);
        file_put_contents($tableFile,$footer,FILE_APPEND);
    }catch (Exception $e) {
        var_dump($e);
    }
}
return $tables;
}

/**
* Exécute la méthode writeTableFile
* Renvoie true si l'exécution s'est bien passée, false sinon
*/
public static function start(HttpRequest $request) : bool
{
$isForce = count($request->route) > 1 && $request->route[1] == 'force';
try{
    HttpRequest::instance($request);
    Initializer::writeTableFile($isForce);
    $tables = DatabaseService::getTables();
    Initializer::writeSchemasFiles($tables,$isForce);
    }
    catch(Exception $e){
        return false;
    }
        return true;
    }

/**
* Génère une classe schema (crée le fichier) pour chaque table présente dans $tables
* décrivant la structure de la table à l'aide de DatabaseService getSchema()
* Si $isForce vaut false et que la classe existe déjà, elle n'est pas réécrite
* Si $isForce vaut true, la classe est supprimée (si elle existe) et réécrite
*/
        private static function writeSchemasFiles ( array $tables , bool $isForce ) : void
        {
            foreach ( $tables as $table ){
            $className = ucfirst ( $table );
            $schemaFile = "src/Schemas/$className.php" ;
            if ( file_exists ($schemaFile) && $isForce ){
                if(!unlink($schemaFile)){
                    throw new Exception("Fichier insuprimable!");
                };
            }     
            if (!file_exists($schemaFile)){
                
                    $headerfile = "<?php namespace Schemas ; \n \n class $className {\n \n \t const COLUMNS = [ \n" ;
                        $dbs = new DatabaseService($table);
                        $schemaOfTheTable = $dbs->getSchema($table);
                        $body="";
                        $comma="";
                        foreach($schemaOfTheTable as $col){
                            $nullvar=$col->Null=="NO"?"0":"1";
                            $body.=$comma;
                            $line="\t\t'".$col->Field."'=>['type'=>'".$col->Type."', 'nullable'=>".$nullvar.",'default'=>'".$col->Default."']";
                            $body.=$line;
                            $comma=",\n";
                        }
                        $body.="\n\n";
                        $footer = "\t];\n\n\n}";
                        $contentfile=$headerfile.$body.$footer;
                        if(!file_put_contents($schemaFile,$contentfile))
                        { 
                            throw new Exception("Erreur d'écriture du fichier");
                        }
                        

                    }
                }
         }
        


}
