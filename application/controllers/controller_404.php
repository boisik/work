<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 20:00
 */
use Application\Core\Controller;
class Controller_404 extends Controller
{

    function action_index()
    {
        $this->view->generate('error_view.php', 'template_view.php','error_404');
    }

}