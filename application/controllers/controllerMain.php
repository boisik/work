<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 11.06.2020
 * Time: 17:24
 */

use Application\Core\Controller;
class ControllerMain extends Controller
{

    function actionIndex()
    {

        header("Location:".'/task');

    }
}