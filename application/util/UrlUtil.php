<?php
namespace application\util;

class UrlUtil{
    // .htaccess에서 분류한 subdirectory가 있으면 path에 담고 없으면 공백을 담음
    public static function getUrl(){
        return isset($_GET["url"]) ? $_GET["url"] : "";
    }

    // 위의 함수를 UrlUtil::getUrl()
    public static function getUrlArrPath(){
        $path = self::getUrl(); // UrlUtil::getUrl() -> self::getUrl()
        return $path !== "" ? explode("/", $path) : "";
    }

    // \를 /로 변환
    public static function replaceSlashToBackSlash($str){
        return str_replace("/", "\\", $str);
    }
}