<?php

/**
 * Created by PhpStorm.
 * User: 123
 * Date: 11.06.2020
 * Time: 18:28
 */
namespace Application\Models;
use Application\Core\Helper;


class Task
{
    private
        $adapter,
        $id,
        $userName,
        $userEmail,
        $status,
        $edited,
        $text,
        $table = "tasks",
        $empty = "пусто";
    function __construct()
    {
        $this->adapter = new \Application\Core\Adapter();
    }

    /**
     * извлекает из объекта значение свойства userName
     *

     * @return string $userName - имя пользователя
     */


    public function getUserName(){
        return $this->userName;
    }

    public function getUserEmail(){
        return $this->userEmail;
    }

    public function getText(){
        return $this->text;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getEdited(){
        return $this->edited;
    }

    public function getTableName(){
        return $this->table;
    }

    public function getId(){
        return $this->id;
    }

    /**
     * устанавливает объекту значение свойства userName
     *
     * @param string $userName - имя пользователя
     * @return void
     */
    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    public function addText($text){
        $this->text = $text;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setEdited($edited){
        $this->edited = $edited;
    }
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Проверка введенных данных
     * @return array|boolean
     */
    public function checkData()
    {
        $this->userName=stripslashes($this->userName);
        $this->userName=htmlspecialchars($this->userName);
        $this->userEmail=stripslashes($this->userEmail);
        $this->userEmail=htmlspecialchars($this->userEmail);
        $this->text=stripslashes($this->text);
        $this->text=htmlspecialchars($this->text);
        $this->text=trim($this->text);

        $result = array();
        if (empty($this->userName)){
            $result['errors']['emptyUserName'] = "Введите имя";

        }

        if (empty($this->userEmail) || !filter_var($this->userEmail, FILTER_VALIDATE_EMAIL)){
            $result['errors']['emptyUserEmail'] = "Введите корректный адрес электронной почты";
        }

        if (empty($this->text)){
            $result['errors']['emptyText'] = "Опишите задачу";
        }

        $result['noErrors'] = !isset($result['errors']) ? true : false;
        return $result;
    }


    public function create()
    {
        $result = $this->checkData();
        if (isset($result['errors'])){
            return $result['errors'];
        }
        $tableName = $this->getTableName();
        $querry = "INSERT INTO $tableName
                   SET
                   
                   username = '$this->userName',
                   useremail = '$this->userEmail', 
                   text = '$this->text'
                  
                  ;";

        $this->adapter->sqlExec($querry);

        return $result['OK']= 'Задача добавлена, перейдите к списку задач, используя верхнее меню';
    }


    /**
     * внесение изменения в задачу
     *
     * @param Task - объект до перезаписи
     * @return array
     */

    function update($task)
    {
        $this->text=stripslashes($this->text);
        $this->text=htmlspecialchars($this->text);
        $this->text=trim($this->text);
        $oldText =  trim($task->getText());
       
        $newText = $this->getText();
        $editied = (strcasecmp($oldText,$newText) == "0") ? '0' : '1';

        $querry = "UPDATE  $this->table
                   SET                   
                   text      = '$this->text',
                   status    = '$this->status',
                   edited   =   '$editied'        
                    WHERE id = '$this->id'
                  ;";
        $result = $this->adapter->sqlExec($querry);

        $arrayResult['OK']= 'Поля задания обновлены';
        return $arrayResult;
    }













}