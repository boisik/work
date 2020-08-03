<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 20:00
 */
use Application\Core\Controller;
class Controller403 extends Controller
{

    function actionIndex()
    {
        $this->view->generate('errorView.php', 'templateView.php','error_403, Please AUTH');
    }

}