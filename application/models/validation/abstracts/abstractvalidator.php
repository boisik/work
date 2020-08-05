<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 28.07.2020
 * Time: 12:59
 */

namespace Application\Models\Validation\Abstracts;


abstract class AbstractValidator
{
    protected $errors = array();
    protected $data;
    protected $conditions;
    protected $messages;

    /**
     * конструктор валидатора
     *
     * @param array $data
     * @param array $conditions
     * @param array $messages
     */
    public function __construct(array $data, array $conditions, array $messages = [])
    {
        $this->data = $data;
        $this->conditions = $conditions;
        $this->messages = $messages;

    }

    /**
     * Производит валидацию данных, помещает отшибки в массив $errors
     * @return void
     */
    abstract function validate();


    /**
     * @param $message array массив входящих данных
     * @return void
     */
    public function addError($fieldAlias,$message) {
        $this -> errors[$fieldAlias] = $message;
    }

    /**
     * Возвращает информацию об ошибках
     * @return array|bool
     */
    public function getErrors() {
        return $this -> errors;
    }
}