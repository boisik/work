<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 02.08.2020
 * Time: 18:15
 */

namespace Application\Models\Validation\Conditions;
use Application\Models\Validation\Abstracts\AbstractCondition;
use Application\Models\Validation\Exceptions\ConditionTypeException;
use Application\Models\Validation\Exceptions\ConditionException;
use Application\Models\User;
class CanAuth extends AbstractCondition
{
    /**
     * Валидирует данные, проверяет существование пользователя с указанными данными
     *
     * @param mixed $data
     *
     * @return bool
     * @throws ConditionTypeException
     */
    public function isOk($data = null,$message = null)
    {
        $user = new User();
        $user->setLogin($data['add_login']);
        $user->setPass($data['add_pass']);
        $user->screenImportantFields();
        $userCanAuth = $user->userCanAuth();
        if(!$userCanAuth){
            $this->errorMessage =$message;
            return false;
        }
        return true;
    }
}