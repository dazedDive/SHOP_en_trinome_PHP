<?php namespace Helpers;

use Exception;

class Token{
    private static $prefix = "$2y$08$"; //bcrypt (salt = 8)
    private static $defaultValidity = 3600;

    private function __construct()
    {
        $args = func_get_args();
        if(empty($args)){
            throw new Exception("one argument required");
        }
        elseif(is_array($args[0])){
            $this->encode($args[0]);
        }
        elseif(is_string($args[0])){
            $this->decode($args[0]);
        }
        else{
            throw new Exception("argument must be a string or an array");
        }
    }
        public array $decoded ; //stocke le tableau de données
        public string $encoded ; //stocke le token
        public static function create ( $entry ) : Token
            {
            return new Token ( $entry );
            }

                /**
        * 1. Crée un token à partir d'un tableau de données
        * 2. $decoded contient les informations à stocker dans la token
        * Si les entrées createdAt, usableAt, validity et expireAt
        * ne sont pas fournies dans $decoded, il faut les ajouter
        * 3. un token est composé d'un payload et d'une signature
        * (séparé par un caractère remarquable qui permettra un découpage)
        * Le payload est un encodage en base64 du tableau de données (stringifié)
        * La signature est égale au payload hashé en bcrypt (salt = 8)
        * Le token, une fois construit, doit être encodé pour être transmis dans un url
        */
        private function encode ( array $decoded = []) : void
        {

            
            $timeStamp=time();
            if (!isset($decoded['createdAt'])){
            $decoded['createdAt']=$timeStamp;
            }
            if (!isset($decoded['usableAt'])){
            $decoded['usableAt']=$timeStamp;
            }
            if (!isset($decoded['validity'])){
            $decoded['validity']=Token::$defaultValidity;
            }
            if (!isset($decoded['expireAt'])){
            $decoded['expireAt']=$timeStamp+$decoded['validity'];
            }
           
        
        
        $this->decoded = $decoded;
        
        $tokenName=["tokenName"=>"testDeToken"];
        $decoded=array_merge($decoded,$tokenName);
        $payload=[];
        
        foreach ($decoded as $k => $v) {
            array_push($payload,$k);
            array_push($payload,$v);
        }
        $payload=base64_encode(implode("¤",$payload));
        $signature = password_hash ( $payload , PASSWORD_BCRYPT, [ 'cost' => 8 ]);
        $encoded = $payload."|".$signature."|".Token::$prefix;
        $this -> encoded = $encoded;
        }

        /**
        * Décode un token pour obtenir le tableau de données initial
        */
        private function decode ( string $encoded ) : void
        {
        $this->encoded = $encoded;
        $splitToken = explode("|",$encoded);
        $signature=$splitToken[1];
        $prefix=$splitToken[2];
        if(password_verify($splitToken[0],$signature)&&$prefix==Token::$prefix){
        $payload=base64_decode($splitToken[0]);
        $payload=explode("¤",$payload);
        $decoded=[];
        for($i=0,$j=1;$j<count($payload);$i=$i+2,$j=$j+2){
            $decoded[$payload[$i]]=$payload[$j];
             }
        }
        $this->decoded = $decoded ?? null ;
        }
        /**
        * Vérifie la validité du token encodé ($this->decoded not null)
        * si $withDate vaut true vérifie également les dates expireAt et usableAt
        */
        public function isValid ( bool $withDate = true ) : bool
        {
        if (! isset ( $this -> decoded )){
        return false ;
        }
        if ( $withDate ){
            $tokendecoded=$this->decoded;
            $checkTime=$tokendecoded['expireAt'];
            $timeStamp=time();
            if ($timeStamp<$checkTime){
                return true;
            }else{
                return false;
            }
           
        }
        return true ;
        }
}
?>
