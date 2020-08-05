<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 31.07.2020
 * Time: 21:02
 */
use Application\Core\Controller;
use Application\Models\Validation\RegValidator;
use Application\Models\Validation\Forms\RegForm;
class controllerRegistration extends Controller
{

    function actionAddUser()
    {
        if ($_POST['operation'] =='adduser'){
            //var_dump($_POST);
            $userName = filter_input(INPUT_POST, 'add_name');
            $email = filter_input(INPUT_POST, 'add_email');
            $login = filter_input(INPUT_POST, 'add_login');
            $password = filter_input(INPUT_POST, 'add_pass');
            $messages = array(
                "add_login"=>'Не корректный логин',
                "add_pass"=>'Не корректный пароль',
                "add_email"=>'Не корректный адрес электронной почты',
                "add_name"=>'Не корректное имя',
            );
            $form = new RegForm();
            $conditions = $form->getConditions();

            $RegValidator = new RegValidator($_POST,$conditions,$messages);
            $RegValidator ->validate();
            $errors = $RegValidator->getErrors();

            if (empty($errors)){
                $user = new \Application\Models\User();
                $user->setLogin($login);
                $user->setName($userName);
                $user->setEmail($email);
                $user->setPass($password);

                $result = $user->createUser();
            }else{
                $result = $errors;
            }



            $this->view->generate('resultView.php', 'answerView.php',$result);

        }else{
            $this->view->generate('addUserView.php', 'templateView.php');
        }
    }

}