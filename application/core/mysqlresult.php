<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 18:55
 */
namespace Application\Core;


class Mysqlresult
{
    protected

        $resource,
        $res_type = MYSQLI_ASSOC;

    function __construct($resource)
    {
        $this -> resource = $resource;
    }
    /**
     * Возвращает список строк результата
     *
     * @return array
     */
    function fetchAll()
    {
        $res = array();
        while ($row = $this->fetchRow()) {
            $res[] = $row;
        }
        return $res;
    }

    /**
     * Возвращает одну строку результата
     *
     * @return array
     */
    function fetchRow()
    {
        if (is_bool($this->resource)) return false;
        $row = mysqli_fetch_array($this -> resource, $this -> res_type);

        return $row ?: false;
    }
}