<?php 

class Application{
    public function __construct(){
        $path = UrlUtil::getUrlArrPath();
        $identityName = empty($path[0]) ? "Shop" : ucfirst($path[0]);
        $action = empty($path[1]) ? "main" : ucfirst(strtolower($_SERVER["REQUEST_METHOD"]));
    }
}

?>