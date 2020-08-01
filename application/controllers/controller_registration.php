<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 31.07.2020
 * Time: 21:02
 */
use Application\Core\Controller;
class controller_Registration extends Controller
{

    function action_addUser()
    {
        if ($_POST['operation'] =='adduser'){
            //var_dump($_POST);
            $userName = filter_input(INPUT_POST, 'add_name');
            $email = filter_input(INPUT_POST, 'add_email');
            $login = filter_input(INPUT_POST, 'add_login');
            $user = new \Application\Models\User();
            $user->setUserName($userName);
            $user->setUserEmail($email);

            $result = $task->create();

            $this->view->generate('result_view.php', 'answer_view.php',$result);

        }else{
            $this->view->generate('addtask_view.php', 'template_view.php');
        }
    }

}