<?php
namespace Controllers;

class DatabaseController{
    public function __construct($request){
        $this->action=null;
        $route=$request[0];
        $id=$request[1];
        if(isset($id) && !ctype_digit($id)){ 
            return $this;  
          }

    }

}
?>