<?php namespace Tools;

use Exception;
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
//???
}
catch(Exception $e){
return false;
}
return true;
}

}
