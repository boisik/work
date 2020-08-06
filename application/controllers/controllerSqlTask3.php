<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 04.08.2020
 * Time: 6:29
 */
use Application\Core\Controller;
use Application\Models\SqlModel;
class controllerSqlTask3 extends Controller
{

    function actionIndex()
    {
        $model = new SqlModel();
        //$model->getAllFromUsersTable();
        //$model->getAllFromOrdersTable();
        $result = $model->getTask3Result();
        $this->view->generate('taskView.php', 'templateView.php',$result);
    }

}