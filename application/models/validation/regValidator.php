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
class RegValidator extends DefaultValidator
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
            if (!$conditionObject->isOk($this->data['add_login'],'Пользователь стаким логином уже существует')){

            } else {
                $this->addError('add_login', $conditionObject->errorMessage);
            }
        }



    }
}