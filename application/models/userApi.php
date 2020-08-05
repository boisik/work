<?php
/**
 * Created by PhpStorm.
 * User: alink
 * Date: 04.08.2020
 * Time: 6:31
 */

namespace Application\Models;


class userApi
{
    function __construct()
    {
        $this->obj = new \Application\Models\User();
        $this->adapter = new \Application\Core\Adapter();
    }

    /**
     * загружает задание из бд
     *
     * @param int $id - идентификатор задачи
     * @return User
     */
    function getByID($id)
    {
        $tableName = $this->obj->getTableName();
        $querry = "SELECT *  
                   FROM $tableName
                   WHERE   id = '$id'
                ;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchRow();
        $newobj = new \Application\Models\User();

        $newobj->setName($result['name']);

        return $newobj;
    }




}