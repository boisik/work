<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 18:54
 */

namespace Application\Core;



class Autoloader
{
    private static  $require_path;

    function __construct()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    /*
    * @return void
    */
    function autoload($class_name)
    {
        $class_name = strtolower(str_replace(array('\\', '.'), array('/', ''), $class_name));
        $require_path = self::getPath();

        if ($class_name{0} == 'r' && $class_name{1} == 's' && $class_name{2} == '/') {
            //Классы ядра
            $class_path = $require_path['systemClass'].$class_name;
        } else {
            //Классы модулей
            $class_path = $require_path['moduleClass'].$class_name;
        }


        $class = $class_path.'.'.'php';


        if (file_exists( $class )) {
            require( $class );
        }
    }



    /**
     * Возвращает массив текущих путей для поиска классов
     *
     * @return array
     */
    public static function getPath()
    {
        return self::$require_path;
    }


}

new Autoloader();
