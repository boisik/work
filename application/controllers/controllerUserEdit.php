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
class controllerUserEdit extends Controller
{

    function actionEditUser()
    {
        if(!User::isAuth()) Route::ErrorPage403();

        $taskApi = new Application\Models\Taskapi();
        $id = isset($_GET['id']) ? $_GET['id'] : '0';
        $task = $taskApi->getByID($id);

        if ($_POST['operation'] =='edittask'){


            $status = isset($_POST['add_status'])? "1":"0";
            $text = filter_input(INPUT_POST, 'add_text');
            $taskModified = new \Application\Models\Task();

            $taskModified->setStatus($status);
            $taskModified->setId($id);
            $taskModified->addText($text);
            $result = $taskModified->update($task);

            $this->view->generate('resultView.php', 'answerView.php',$result);

        }else{
            $this->view->generate('edittaskView.php', 'templateView.php',$task);
        }
    }

}