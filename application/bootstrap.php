<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 19:38
 */
namespace Application;
use Application\Core\Adapter;
class Bootstrap
{
    public static
        $CLASS_EXT       = 'php',    //Расширение файлов с классами
        $SECRET_SALT     = 'LalkaViktor#$%^',//Соль безопасности
        $DB_HOST         = 'localhost',
        $DB_PORT         = null,
        $DB_SOCKET       = null,
        $DB_NAME         = ' ',
        $DB_USER         = ' ',
        $DB_PASS         = ' ';

    protected static
        //Подключаемые модули
        $include_list = array(
        'core/route.php',
        'core/model.php',
        'core/view.php',
        'core/controller.php',
    );
    /**
     * Инициализирует основные настройки системы
     *
     * @return void
     */
    public static function init()
    {
        foreach (self::$include_list as $inc_file) include($inc_file);
        self::loadConfig();
        Adapter::connect();               // соединение с бд
        \Application\Core\Route::start(); // запускаем маршрутизатор
    }

    /**
     * Загружает настройки из файла конфигурации
     * @return void
     */
    public static function loadConfig()
    {
        $file = 'config.php';
        if (file_exists($file)) {

            $data = include($file);
            foreach($data as $key => $value) {
                if ($value !== null && property_exists(get_called_class(), $key)) {
                    self::$$key = $value;
                }
            }
        }
    }


}
