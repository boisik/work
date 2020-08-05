<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 31.07.2020
 * Time: 3:12
 */
namespace Application\Models\Validation\Exceptions;
class ConditionException extends \Exception
{
    protected $extra_info = '';

    function __construct($message = '', $code = 0, \Exception $previous = null, $extra_info = '')
    {
        $this->extra_info = $extra_info;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Возвращает дополнительную информацию об ошибке
     * @return string
     */
    public function getExtraInfo()
    {
        return $this->extra_info;
    }

}