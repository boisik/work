<?php


ini_set('display_errors', 1);
include('application/core/autoloader.php');

use Application\Bootstrap;
class Setup extends Application\Bootstrap
{
    /**
     * Инициализирует настройки проекта
     */
    public static function init()
    {

        parent::init();
    }
}

\Setup::init();
