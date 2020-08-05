<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 31.07.2020
 * Time: 2:17
 */

namespace Application\Models\Validation\Conditions;
use Application\Models\Validation\Abstracts\AbstractCondition;


class Email extends  AbstractCondition
{
    private
        $defaultMessage = 'Указанный почтовый адрес невалиден';
    /**
     * Валидирует данные, проверяет является ли входящее значение
     * адресом электронной почты
     *
     * @param mixed $data
     * @param string $message
     * @return bool
     */
    public function isOk($data = null,$message = null)
    {
        $message = (isset($message)) ? $message : $this->defaultMessage;
        if (!preg_match('/^.+\@\S+\.\S+$/', $data)) {
            $this->errorMessage = $message;
            return false;
        }
        return true;
    }

}