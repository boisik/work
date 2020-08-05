<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 02.08.2020
 * Time: 17:37
 */

namespace Application\Models\Validation\Forms;
use Application\Models\Validation\Abstracts\AbstractForm;


class RegForm extends AbstractForm
{
    /**
     * @return array  список правил
     */
    function getConditions()
    {


        return array(

            "add_login"=>array(
                array('Application\\Models\\Validation\\Conditions\\Length'=>array('min' => '3','max' => '10')),

            ),
            "add_pass"=>array(
                array('Application\\Models\\Validation\\Conditions\\Length'=>array('min' => '6','max' => '10')),

            ),

            "add_email"=>array(
                array('Application\\Models\\Validation\\Conditions\\Email' => null)
            ),

            "add_name"=>array(
                array('Application\\Models\\Validation\\Conditions\\Length'=>array('min' => '3','max' => '10')),

            ),
        );
    }
}