<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 06.08.2020
 * Time: 19:09
 */

namespace Application\Models;



class SqlModel
{

    function __construct()
    {
        $this->adapter = new \Application\Core\Adapter();
    }

    function getAllFromUsersTable()
    {
        $querry = "SELECT *  
                   FROM users
                   
                ;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();

        return array('querry'=>$querry,'result'=>$result);
    }

    function getAllFromOrdersTable()
    {
        $querry = "SELECT *  
                   FROM orders
                   
                ;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();

        return array('querry'=>$querry,'result'=>$result);
    }

    function getTask3Result()
    {
        $querry = "
        SELECT 
         U.login,count(*) AS \"Amount\"
        FROM
         users U
         JOIN orders O ON U.id = O.user_id
        GROUP BY
         U.login
        HAVING count(*) > 2;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();
        return array('querry'=>$querry,'result'=>$result);
    }

    function getTask2Result()
    {
        $querry = "
        SELECT 
          U.login,U.name
        FROM
          users U
        LEFT JOIN orders O ON U.id = O.user_id
        WHERE O.user_id IS NULL;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();
        return array('querry'=>$querry,'result'=>$result);
    }

    function getTask1Result()
    {
        $querry = "
        SELECT 
         U.email,count(*) AS \"Amount\"
        FROM
         users U        
        GROUP BY
         U.email
        HAVING count(*) > 1;";

        $result = $this->adapter->sqlExec($querry);
        $result = $result->fetchAll();

        return array('querry'=>$querry,'result'=>$result);
    }
}