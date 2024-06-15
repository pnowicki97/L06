<?php

require_once 'src/controllers/AppController.php';
require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/DesktopUserPageController.php';
require_once 'src/controllers/DesktopGroupPageController.php';
require_once 'src/controllers/MainController.php';
require_once 'src/repository/ProjectRepository.php';
require_once 'src/models/Project.php';
require_once 'Database.php';


class Routing {

    public static $routes;


    public static function get($url, $controller){
        self::$routes[$url] = $controller;
    }

    public static function post($url, $view)
    {
        self::$routes[$url] = $view;
    }
    
    public static function run($url){

        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if(!array_key_exists($action, self::$routes)){
            die("Wrong url");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'main';

        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }
}