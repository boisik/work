<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 13.06.2020
 * Time: 12:41
 */
use Application\Core\Controller;

class ControllerAuth extends Controller
{


    function actionIndex()
    {
        $this->view->generate('authView.php', 'templateView.php');
    }

    function actionAuth()
    {
        if ($_POST['operation'] =='auth'){
            $login = filter_input(INPUT_POST, 'add_login');
            $pass = filter_input(INPUT_POST, 'add_pass');
            $user = new \Application\Models\User();
            $user->setLogin($login);
            $user->setPass($pass);
            $result = $user->tryAuth();

            $this->view->generate('resultView.php', 'answerView.php',$result);

        }

    }


    function actionLogout()
    {
        $user = new \Application\Models\User();
        $user->logOut();
    }

}