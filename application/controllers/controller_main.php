<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 11.06.2020
 * Time: 17:24
 */

use Application\Core\Controller;
class Controller_Main extends Controller
{

    function action_index()
    {

        header("Location:".'/task');

    }
}