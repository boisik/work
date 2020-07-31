<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 13.06.2020
 * Time: 15:20
 */


if (is_array($data)){
    foreach ($data as $one){
    print_r($one."<br>");
    }
}else{
    print_r($data);
}

