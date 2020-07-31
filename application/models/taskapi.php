<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 15.06.2020
 * Time: 16:37
 */

namespace Application\Models;


class TaskApi
{

    function __construct()
    {
        $this->obj = new \Application\Models\Task();
        $this->adapter = new \Application\Core\Adapter();
    }

    /**
     * загружает список заданий из бд
     *
     * @param string $columnName - указатель по какой колонке сортировать
     * @param string $vector - тип сортировки
     * @param string $offset - сдвиг для пагинации
     * @return array
     */

    public function getList($columnName = 'username',$vector = ' ASC',$offset)
    {
        $tableName = $this->obj->getTableName();

        $querry = "SELECT *  
                   FROM $tableName
                   ORDER BY $columnName $vector
                   LIMIT 3 
                   OFFSET $offset
                ;";


        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();
        foreach ($result as $key => $one){
            $newobj = new \Application\Models\Task();
            $newobj->setId($one['id']);
            $newobj->setUserName($one['username']);
            $newobj->setUserEmail($one['useremail']);
            $newobj->addText($one['text']);
            $newobj->setStatus($one['status']);
            $newobj->setEdited($one['edited']);
            $result[$key] = $newobj;
            unset($newobj);
        }

        return $result;
    }

    /**
     * загружает задание из бд
     *
     * @param int $id - идентификатор задачи
     * @return Task
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
        $newobj = new \Application\Models\Task();
        $newobj->setId($result['id']);
        $newobj->setUserName($result['username']);
        $newobj->setUserEmail($result['useremail']);
        $newobj->addText($result['text']);
        $newobj->setStatus($result['status']);
        $newobj->setEdited($result['edited']);
        return $newobj;
    }

    /**
     * возвращает число записей о задачах
     *
     *
     * @return int
     */
    function getCountTasks()
    {
        $tableName = $this->obj->getTableName();
        $querry = "SELECT COUNT(*) FROM $tableName; ";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchRow();

        return array_shift($result);
    }

}