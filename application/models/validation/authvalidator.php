<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 05.08.2020
 * Time: 2:51
 */
namespace Application\Models\Validation;

use Application\Models\Validation\Interfaces\ConditionInterface;
use Application\Models\Validation\Exceptions\ValidatorException;
class AuthValidator extends DefaultValidator
{
    /**
     * Производит валидацию данных, помещает отшибки в массив $errors
     * @return void
     */
    function validate()
    {
        parent::validate();

        if (!empty($this->data['add_login'])){
            $conditionObject = new \Application\Models\Validation\Conditions\UserExist();
            if ($conditionObject->isOk($this->data['add_login'],'Пользователя стаким логином не существует')){
                if (!empty($this->data['add_pass'])){
                    $conditionObject = new \Application\Models\Validation\Conditions\CanAuth();
                    if ($conditionObject->isOk(array(
                        'add_login'=>$this->data['add_login'],
                        'add_pass'=>$this->data['add_pass'],
                        ),'Пароль указан не верно')){
                }else
                    {
                        $this->addError('add_pass', $conditionObject->errorMessage);
                    }
                }
            } else {
                $this->addError('add_login', $conditionObject->errorMessage);
            }
        }



    }
}