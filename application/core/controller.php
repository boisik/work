<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 19:04
 */

namespace Application\Core;
use Application\Core\View;
abstract class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    // действие (action), вызываемое по умолчанию
    function action_index()
    {

    }
}