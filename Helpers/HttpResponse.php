<?php namespace Helpers;

class HttpResponse {
  public function __construct($respons)
  {
    
    if(http_response_code($respons)<300){
        $this->send($this->data);
    }
    else{
        $this->exit();
    }
  }

public static function send( array $data , int $status = 200 ) : void
{   
    $response = json_encode($data);
    echo($response);
    die;
}

public static function exit ( int $status = 404 ) : void
{
    header('HTTP/1.0 404 Not Found');
    die;
}
}