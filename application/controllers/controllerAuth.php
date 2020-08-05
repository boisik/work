<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 13.06.2020
 * Time: 12:41
 */
use Application\Core\Controller;
use Application\Models\Validation\AuthValidator;
use Application\Models\Validation\Forms\AuthForm;
class ControllerAuth extends Controller
{


    function actionIndex()
    {
        $this->view->generate('authView.php', 'templateView.php');
    }

    function actionAuth()
    {
        $messages = array(
            "add_login"=>'Не корректный логин',
            "add_pass"=>'Не корректный пароль',
        );
        if ($_POST['operation'] =='auth'){
            $login = filter_input(INPUT_POST, 'add_login');
            $pass = filter_input(INPUT_POST, 'add_pass');

            $form = new AuthForm();
            $conditions = $form->getConditions();

            $AuthValidator = new AuthValidator($_POST,$conditions,$messages);
            $AuthValidator ->validate();
            $errors = $AuthValidator->getErrors();
            if (empty($errors)){
                $user = new \Application\Models\User();
                $user->setLogin($login);
                $user->setPass($pass);
                $result = $user->tryAuth();
            }else{
                $result = $errors;
            }






            $this->view->generate('resultView.php', 'answerView.php',$result);

        }

    }


    function actionLogout()
    {
        $user = new \Application\Models\User();
        $user->logOut();
    }

}