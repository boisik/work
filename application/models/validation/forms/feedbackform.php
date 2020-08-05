<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 02.08.2020
 * Time: 19:51
 */

namespace Application\Models\Validation\Forms;
use Application\Models\Validation\Abstracts\AbstractForm;

class FeedBackForm extends AbstractForm
{
    /**
     * @return array  список правил
     */
    function getConditions()
    {


        return array(
            "emailAlias"=>array(
                array('Application\Models\Validation\\Conditions\\Email' => null)
            ),
            "nameAlias"=>array(
                array('Application\Models\Validation\\Conditions\\Length' => ['min' => '3','max' => '10']),
                array('Application\Models\Validation\\Conditions\\Length' => ['min' => '5','max' => '8']),  //да правило такоеже, это для наглядности.

            ),
            "confirmAlias"=>array(
                array('Application\Models\Validation\\Conditions\\IsTrue' => null),

            ),
        );
    }
}