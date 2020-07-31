<?php
/**
 * Created by PhpStorm.
 * User: Керчь
 * Date: 15.06.2020
 * Time: 4:17
 */

use Application\Core\Controller;
use Application\Models\User;
use Application\Core\Route;
class Controller_Task extends Controller
{



    function action_index()
    {
        $taskApi = new Application\Models\Taskapi();
        $page = isset($_GET['page']) ? $_GET['page'] : "0";
        $vector = isset($_GET['vector']) ? $_GET['vector'] : "ASC";
        $columnName = isset($_GET['columnName']) ? $_GET['columnName'] : "username";
        $nextVector = $vector == "ASC" ? "DESC" : "ASC";
        $tasks = $taskApi->getList($columnName,$vector,$page*3);
        $paginator = $taskApi->getCountTasks();
        $result['list'] = $tasks;
        $result['nextVector'] = $nextVector;
        $result['vector'] = $vector;
        $result['page'] = $page;
        $result['columnName'] = $columnName;
        $result['paginator'] = $paginator/3;
        $this->view->generate('tasklist_view.php', 'template_view.php',$result);
    }

    function action_addTask()
    {
        if ($_POST['operation'] =='addtask'){
            //var_dump($_POST);
            $userName = filter_input(INPUT_POST, 'add_name');
            $email = filter_input(INPUT_POST, 'add_email');
            $text = filter_input(INPUT_POST, 'add_text');
            $task = new \Application\Models\Task();
            $task->setUserName($userName);
            $task->setUserEmail($email);
            $task->addText($text);
            $result = $task->create();

            $this->view->generate('result_view.php', 'answer_view.php',$result);

        }else{
            $this->view->generate('addtask_view.php', 'template_view.php');
        }
    }

    function action_editTask()
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

            $this->view->generate('result_view.php', 'answer_view.php',$result);

        }else{
            $this->view->generate('edittask_view.php', 'template_view.php',$task);
        }
    }
}