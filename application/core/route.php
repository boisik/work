<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 18:58
 */

namespace Application\Core;

class Route
{

    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        $uri = $_SERVER['REQUEST_URI'];
        $uri = stripos($uri, "?") ? stristr($uri, '?', true):$uri;

        $routes = explode('/', $uri);


        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }


        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;





        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
        }


        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {

            Route::ErrorPage404();
            die;
        }


        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {

            $controller->$action();
        }
        else
        {

            Route::ErrorPage404();
            die;
        }

    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');

    }

    static function ErrorPage403()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 403 Forbidden');
        header("Status: 403 Forbidden");
        header('Location:'.$host.'403');

    }


    /**
     * Вызов нужного екшена в любом месте для фронта
     * @return string
     * @throws Exception
     */

    public static function getUrl($controller_name,$action_name = "", $params = array())
    {

        if (!isset($controller_name)){
            throw new Exception('Не хватает обязательных параметров для построения маршрута',0,null,"testinfo");
        }
        if (!empty($action_name)) $action_name = "/".$action_name;
        $uri =$params ? '?'.http_build_query($params): " ";


       echo   "/".$controller_name.$action_name.$uri;
    }

}
