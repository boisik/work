<?php

/**
 * Created by PhpStorm.
 * User: 123
 * Date: 11.06.2020
 * Time: 18:28
 */
namespace Application\Models;
use Application\Core\Helper;


class User
{
    private
        $adapter,
        $password,
        $login,
        $name,
        $email,
        $table = "users",
        $importantFields = array('login','name','email','password');

    function __construct()
    {
        $this->adapter = new \Application\Core\Adapter();
    }

    /**
     * устанавливает объекту заничение свойства $password
     *
     * @param string $password - пароль в открытом виде
     * @return void
     */
    public function setPass($password)
    {
        $this->password = $password;//self::cryptPass($password);
    }

    /**
     * устанавливает объекту значение свойства $login
     *
     * @param string $name - имя пользователя
     * @return void
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * устанавливает объекту заничение свойства $password
     *
     * @param string $password - пароль в открытом виде
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
       return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getTableName(){
        return $this->table;
    }

    /**
     * Экранирует данные
     *
     */
    function screenImportantFields()
    {
        foreach ($this->importantFields as $one){
            if (isset($this->$one)){
                $this->$one = stripslashes($this->$one);
                $this->$one = htmlspecialchars($this->$one);
            }
        }
    }

    /**
     * Проверка базовых введенных данных
     * @return array|boolean
     */
    public function checkBaseData()
    {

        $this->login = stripslashes($this->login);
        $this->login = htmlspecialchars($this->login);
        $this->password = stripslashes($this->password);
        $this->password = htmlspecialchars($this->password);

        $result = array();
        if (empty($this->login)) {
            $result['errors']['emptyLogin'] = "Введите Логин";
            return $result;
        }


        if (empty($this->password)) {
            $result['errors']['emptyPass'] = "Введите пароль";
            return $result;
        }
        $result['noErrors'] = !isset($result['errors']) ? true : false;
        return $result;
    }
    /**
     * Дальнейшая проверка данных, необходима для авторизации
     * @return array|boolean
     */
    public function checkAuthData($validationResult)
    {
       $userExist = $this->userExist();

        if (empty($userExist)){
            $validationResult['errors']['emptyUser'] = "Пользователя с таким Логином не существует";
            return $validationResult;
        }

        if($userExist[0]['password'] != $this->cryptPass($this->password)){
            $validationResult['errors']['wrongPass'] = "Пароль указан неверно";
        }

        $validationResult['noErrors'] = !isset($validationResult['errors']) ? true : false;
        return $validationResult;
    }

    /**
     * Производится попытка авторизации
     * @return array|boolean
     */
    function  tryAuth()
    {
        $validationResult = $this->checkBaseData();
        if ($validationResult['noErrors'] == true){
            $validationResult = $this->checkAuthData($validationResult);
        }
        if ($validationResult['noErrors'] == true){

            $hash = Helper::generateCode();

            setcookie("user_hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!
        return $validationResult['OK']= 'Авторизация прошла успешно';
        }
        return $validationResult['errors'];
    }

    /**
     * Функция разавторизации
     */
    public function logOut()
    {
        setcookie("user_hash","",time()-3600,"/");

        header("Location:".'/');
    }

    /**
     * Проверка авторизовывался ли пользователь
     * @return boolean
     */
    public static  function isAuth()
    {
       return $result = isset($_COOKIE['user_hash']) ? true : false;
    }



    public function createUser()
    {
        $this->screenImportantFields();
        $validationResult = $this->checkBaseData();

            $pass = $this->cryptPass($this->password);

            $querry = "INSERT INTO $this->table
                   SET
                   email = '$this->email',
                   login = '$this->login',
                   name = '$this->name',
                   password   = '$pass'              
                  
                  ;";

            $result = $this->adapter->sqlExec($querry);

            return $validationResult['OK']= 'Регистрация прошла успешно';




    }



    /**
     * Возвращает хэш от пароля.
     *
     * @param string $password - пароль в открытом виде
     * @return string
     */
    public static function cryptPass($password)
    {
        return md5($password . sha1(\Setup::$SECRET_SALT));
    }

    /**
     * Проверяет базу на предмет существование пользователя с заданным логином
     *
     *
     * @return bool
     */

    function userExist()
    {
        $querry = "SELECT *  
                   FROM $this->table
                   WHERE   login = '$this->login'
                ;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();

        return $result;
    }


    function userCanAuth(){
        $userExist = $this->userExist();
        if($userExist[0]['password'] != $this->cryptPass($this->password)){
            return false;
        }
        return true;

    }

    /**
     * обновляется хеш в таблице пользователей
     * @param string $hash - случайная строка
     */
    function updateUserHash($hash)
    {

        $querry = "UPDATE  $this->table
                   SET                   
                   hash = '".$hash."',
                               
                   WHERE     login = '$this->login'       
                  ;";
        $this->adapter->sqlExec($querry);
    }






}