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
        $table = "users";

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
    public function setPass($password){
        $this->password = $password;//self::cryptPass($password);
    }

    /**
     * устанавливает объекту значение свойства $login
     *
     * @param string $name - имя пользователя
     * @return void
     */
    public function setLogin($login){
        $this->login = $login;
    }

    /**
     * устанавливает объекту заничение свойства $password
     *
     * @param string $password - пароль в открытом виде
     * @return void
     */
    public function setName($name){
        $this->name = $name;
}

    /**
     * Проверка введенных данных
     * @return array|boolean
     */
    public function checkData()
    {
        $this->name=stripslashes($this->name);
        $this->name=htmlspecialchars($this->name);
        $this->login=stripslashes($this->login);
        $this->login=htmlspecialchars($this->login);
        $this->password=stripslashes($this->password);
        $this->password=htmlspecialchars($this->password);
        $result = array();
        if (empty($this->login)){
            $result['errors']['emptyName'] = "Введите Логин";
            return $result;
        }

        if (empty($this->login)){
            $result['errors']['emptyName'] = "Введите Имя";
            return $result;
        }

        if (empty($this->password)){
            $result['errors']['emptyPass'] = "Введите пароль";
            return $result;
        }

        $querry = "SELECT *  
                   FROM $this->table
                   WHERE   name = '$this->login'
                ;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();

        if (empty($result)){
            $result['errors']['emptyUser'] = "Пользователя с таким Логином не существует";
            return $result;
        }

        if($result[0]['password'] != $this->cryptPass($this->password)){
            $result['errors']['wrongPass'] = "Пароль указан неверно";
        }

        $result['noErrors'] = !isset($result['errors']) ? true : false;
        return $result;
    }

    /**
     * Производится попытка авторизации
     * @return array|boolean
     */
    function  tryAuth()
    {
        $validationResult = $this->checkData();

        if ($validationResult['noErrors'] == true){

            $hash = Helper::generateCode();
            $this->updateUserHash($hash);
            setcookie("user_hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!
        return $result['OK']= 'Авторизация прошла успешно';
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

    /**
     * обновляется хеш в таблице пользователей и ip последней авторизации
     * @param string $hash - случайная строка
     */
    function updateUserHash($hash)
    {

        $querry = "UPDATE  $this->table
                   SET
                   
                   hash = '".$hash."',
                   ip   = '".$_SERVER['REMOTE_ADDR']."'              
                  
                  ;";
        $this->adapter->sqlExec($querry);
    }

    public function create()
    {
        $pass = $this->cryptPass($this->password);

        $querry = "INSERT INTO $this->table
                   SET
                   
                   name = '$this->name',
                   password   = '$pass'              
                  
                  ;";

        $result = $this->adapter->sqlExec($querry);

        return $result;
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






}