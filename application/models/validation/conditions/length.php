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
class Length extends AbstractCondition
{

    private
        $defaultMessage = 'введенная строка имеет не допустимую длину длину';
    /**
     * Минимальная длина
     *
     * @var int
     */
    private $min;

    /**
     * Максимальная длина
     *
     * @var int
     */
    private $max;

    /**
     * @param array $spesialParams у разных классов набор может быть разный,
     * чтобы обеспечить стандартный вызов конструктора, сделал вот так
     * @throws ConditionTypeException
     * @throws ConditionException
     */
    public function __construct($specialParams = [] )
    {
        $min =  $specialParams['min'];
        $max =  $specialParams['max'];

        if ($min === null && $max === null) {
            throw new ConditionTypeException();
        }

        if ($min !== null && $max !== null && $min > $max) {
            throw new ConditionException('Минимальное значение не может быть больше максимального,спасибо Капитан');
        }


        $this->min = $min;
        $this->max = $max;

    }



    /**
     * Валидирует данные, проверяет достаточно ли длинная или короткая строка во входящем значении
     *
     * @param mixed $data
     *
     * @return bool
     * @throws ConditionTypeException
     */
    public function isOk($data = null,$message = null)
    {
        $message = (isset($message)) ? $message : $this->defaultMessage;

        if (!is_string ($data)) {
            throw new ConditionTypeException();
        }
        if ($data === null || $data === '') {
            $this->errorMessage = $message;
            return false;
        }


        $length = mb_strlen($data);

        if ($this->max !== null && $length > $this->max) {
            $this->errorMessage =$message;

            return false;
        }

        if ($this->min !== null && $length < $this->min) {
            $this->errorMessage =$message;
            return false;
        }

        return true;
    }


}