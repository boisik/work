<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 18:50
 */
namespace Application\Core;
use Application\Core\Exception;
class Adapter
{
    protected static
        /**
         * Указатель на соединение с базой
         */
        $connection;

    /**
     * Открывает соединение с базой данных
     */
    public static function connect()
    {
        self::$connection = @mysqli_connect(\Setup::$DB_HOST,
            \Setup::$DB_USER,
            \Setup::$DB_PASS,
            \Setup::$DB_NAME,
            (int)\Setup::$DB_PORT,
            \Setup::$DB_SOCKET);
        return self::$connection;

    }

    /**
     * Выполняет sql запрос
     *
     * @param mixed $sql - SQL запрос.
     *
     * @return Mysqlresult
     */
    public static function sqlExec($sql)
    {
        if(!self::$connection){

            throw new Exception('Не установлено соединение с базой данных');

            return new Mysqlresult(false);
        }

        $resource = mysqli_query(self::$connection, $sql);
        $error_no = mysqli_errno(self::$connection);

        if ($error_no != 0) {

            throw new Exception($sql . mysqli_error(self::$connection), $error_no);

            return new Mysqlresult(false);
        }
        return new Mysqlresult($resource);
    }

    /**
     * Проверяет наличие соединения с бд
     *
     * @return string $result
     */
    public static function isConnected()
    {
        if(!self::$connection){
            $result = "Не установлено соединение с базой данных, убедитесь, что верно указали параметры соединения в файле config.php  в корне проектика";
        }else{
            $result = "Успешно установлено соединение с базой данных";
        }
        return $result;
    }



}