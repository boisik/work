<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 19:12
 */

namespace Application\Core;
class View
{


    /*
    @param string $content_view - виды отображающие контент страниц;
    @param string $template_view - общий для всех страниц шаблон;
    @param array $data - массив, содержащий элементы контента страницы.  заполняется в модели.
    */
    function generate($content_view, $template_view, $data = null)
    {
        include 'application/views/'.$template_view;
    }
}