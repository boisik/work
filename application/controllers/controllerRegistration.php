<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 31.07.2020
 * Time: 21:02
 */
use Application\Core\Controller;
class controllerRegistration extends Controller
{

    function actionAddUser()
    {
        if ($_POST['operation'] =='adduser'){
            //var_dump($_POST);
            $userName = filter_input(INPUT_POST, 'add_name');
            $email = filter_input(INPUT_POST, 'add_email');
            $login = filter_input(INPUT_POST, 'add_login');
            $password = filter_input(INPUT_POST, 'add_password');
            $user = new \Application\Models\User();
            $user->setLogin($login);
            $user->setName($userName);
            $user->setEmail($email);
            $user->setPass($password);

            $result = $user->createUser();

            $this->view->generate('resultView.php', 'answerView.php',$result);

        }else{
            $this->view->generate('addUserView.php', 'templateView.php');
        }
    }

}