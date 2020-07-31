<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 18:52
 */
namespace Application\Core;
class Exception extends \Exception
{
    protected
        $extra_info = '';

    function __construct($message = '', $code = 0, Exception $previous = null, $extra_info = '')
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