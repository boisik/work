<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 04.08.2020
 * Time: 6:29
 */
use Application\Core\Controller;
use Application\Models\User;
use Application\Core\Route;
use Application\Models\Validation\DefaultValidator;
use Application\Models\Validation\Forms\UserEditForm;
class controllerUserEdit extends Controller
{

    function actionUserEdit()
    {
        if(!User::isAuth()) Route::ErrorPage403();
        $user = new User();
        $hash = $user->getUserHash();
        $user->getByHash($hash);


        if ($_POST['operation'] =='UserEdit'){
            $userName = filter_input(INPUT_POST, 'add_name');
            $password = filter_input(INPUT_POST, 'add_pass');
            $UserEditForm = new UserEditForm();
            $conditions = $UserEditForm->getConditions();
            $messages = array(
                "add_pass"=>'Не корректный пароль',
                "add_name"=>'Не корректное имя',
            );
            $validator = new DefaultValidator($_POST,$conditions,$messages);
            $validator->validate();
            $errors = $validator->getErrors();
            if (empty($errors)){
               $user->setName($userName);
               $user->setPass($password);
               $result = $user->saveUser();
            }else{
                $result= $errors;
            }
            $this->view->generate('resultView.php', 'answerView.php',$result);

        }else{
            $this->view->generate('EditUserView.php', 'templateView.php',$user);
        }
    }

}