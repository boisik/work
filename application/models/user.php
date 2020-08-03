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

    public function setEmail($email){
        $this->email = $email;
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
            var_dump($userExist[0]['password']);
            var_dump($this->cryptPass($this->password));
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
        $validationResult = $this->checkBaseData();
        $userExist = $this->userExist();
        $this->email = stripslashes($this->email);
        $this->email = htmlspecialchars($this->email);
        $this->name = stripslashes($this->name);
        $this->name = htmlspecialchars($this->name);
        if (empty($this->email) || !preg_match('/^.+\@\S+\.\S+$/', $this->email)) {
            $validationResult['errors']['emptyEmail'] = "Введите корректный Адрес электронной почты";
            return $validationResult['errors'];
        }

        if (empty($this->name)) {
            $validationResult['errors']['emptyName'] = "Введите Имя";
            return $validationResult['errors'];
        }
        if (!empty($userExist)){
            $validationResult['errors']['UserExist'] = "Логин занят другим пользователем";
            return $validationResult['errors'];
        }
        $validationResult['noErrors'] = !isset($validationResult['errors']) ? true : false;
        if ($validationResult['noErrors'] == true){

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
        return $validationResult['errors'];


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
                   WHERE   name = '$this->login'
                ;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();

        return $result;
    }






}