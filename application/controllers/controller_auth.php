<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 13.06.2020
 * Time: 12:41
 */
use Application\Core\Controller;

class Controller_Auth extends Controller
{


    function action_index()
    {
        $this->view->generate('auth_view.php', 'template_view.php');
    }

    function action_auth()
    {
        if ($_POST['operation'] =='auth'){
            $login = filter_input(INPUT_POST, 'add_login');
            $pass = filter_input(INPUT_POST, 'add_pass');
            $user = new \Application\Models\User();
            $user->setLogin($login);
            $user->setPass($pass);
            $result = $user->tryAuth();

            $this->view->generate('result_view.php', 'answer_view.php',$result);

        }

    }


    function action_logout()
    {
        $user = new \Application\Models\User();
        $user->logOut();
    }

}