<?php 
namespace application\lib;
use application\util\UrlUtil;

class Application{
    public function __construct(){
        $path = UrlUtil::getUrlArrPath();
        $identityName = empty($path[0]) ? "Shop" : ucfirst($path[0]);
        $action = (empty($path[1]) ? "main" : $path[1]).ucfirst(strtolower($_SERVER["REQUEST_METHOD"]));
        
        $controllerPath = _PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER._EXTENSION_PHP;

        if(!file_exists($controllerPath)){
            echo "해당 Controller 파일을 찾을 수 없습니다. : ".$controllerPath;
            exit();
        }

        $controllerName = UrlUtil::replaceSlashToBackSlash(_PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER);
        new $controllerName($identityName, $action);
    }
}

?>