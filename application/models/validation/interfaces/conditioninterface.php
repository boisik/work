<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 29.07.2020
 * Time: 0:47
 */

namespace Application\Models\Validation\Interfaces;


interface ConditionInterface
{
    /**
     * Валидирует входящие данные
     *
     * @param mixed $data
     *
     * @return bool
     */
    public function isOk($data = null,$message=null);

}