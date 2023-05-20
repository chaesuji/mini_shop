<?php

namespace application\controller;
use application\util\UrlUtil;
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class Controller{
    protected $model;
    private static $modelList = [];
    private static $arrNeedAuth = [];

    public function __construct($identityName, $action) {
        if(!isset($_SESSION)){
            session_start();
        }

        // 회원가입 및 로그인 권한 체크
        $this->chkAuthorization();

        // model 
        $this->model = $this->getModel($identityName);

        // view
        $view = $this->$action();

        if(empty($view)){
            echo "해당 View 파일을 찾을 수 없습니다. : ".$action;
            exit();
        }

        require_once $this->getView($view);
    }

    protected function getModel($identityName){
        if(!in_array($identityName, self::$modelList)){
            $modelName = UrlUtil::replaceSlashToBackSlash(_PATH_MODEL.$identityName._BASE_FILENAME_MODEL);
            self::$modelList[$identityName] = new $modelName();
        }
        return self::$modelList[$identityName];
    }

    protected function getView($view){
        if(strpos($view, _BASE_REDIRECT) === 0){
            header($view);
            exit();
        }
        return _PATH_VIEW.$view;
    }

    protected function chkAuthorization(){
        $urlPath = UrlUtil::getUrl();
        foreach (self::$arrNeedAuth as $authPath) {
            if(!isset($_SESSION[LOGIN_ID]) && strpos($urlPath, $authPath) === 0){
                header(_BASE_REDIRECT."/user/login");
                exit();
            }
        }
    }

    protected function addDynamicProperty($key, $value){
        $this->$key = $value;
    }
}