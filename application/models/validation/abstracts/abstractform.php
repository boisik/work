<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 28.07.2020
 * Time: 22:08
 */

namespace Application\Models\Validation\Abstracts;


/**
 * конечно можно реализовать одним методом и то и то, ассоциативный массив сделать большой,
 * но в даннйо ситуации я разделил, чтобы не усложнять излишне свою часть задачи
 */

abstract class AbstractForm
{
    private $data = array();//предполагается что в форму каким то образом пришли данные( из поста, их апи, не важно)
    /**
     * @return array  список правил
     */
   function getConditions()
    {

    }


    /**
     * @return array  список полей и их типов
     */
   function  getFields()
    {

    }


    /**
     * например тут проверяем массив $_POST и помещаем содержимое в $data
     */
    function setData(){}



   /**
     * @return array $data
     */
   function getData()
   {
       return $this->data;
   }


}