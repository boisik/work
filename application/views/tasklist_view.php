<?php
use Application\Core\Route;
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 15.06.2020
 * Time: 15:57
 */
?>
<div class="row">
    <div class="marginAuto">
    <?php for ($i = 0; $i < $data['paginator']; $i++) { ?>
        <a class="" href="<?php
        $params = array(
            'columnName' => $data['columnName'],
            'vector'=>$data['vector'],
            'page' =>$i
        );
        Route::getUrl('task','index',$params);?>"
        >
            <?php  printf($i); ?>
        </a>
    <? } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2  col-lg-2 col-sm-2 col-xs-2 center-block">
        Имя
        <a class="" href="<?php
        $params = array(
            'columnName' => 'username',
            'vector'=>$data['nextVector'],
            'page' =>$data['page']
        );
        Route::getUrl('task','index',$params);?>"
        >
            Пересортировать
        </a>
    </div>
    <div class="col-md-2  col-lg-2 col-sm-3 col-xs-2 center-block">
       Почта
        <a class="" href="<?php
        $params = array(
            'columnName' => 'userEmail',
            'vector'=>$data['nextVector'],
            'page' =>$data['page']
        );
        Route::getUrl('task','index',$params);?>"
        >
            Пересортировать
        </a>
    </div>
    <div class="col-md-4  col-lg-4 col-sm-4 col-xs-3 center-block">
       Текст
    </div>
    <div class="col-md-2  col-lg-2 col-sm-2 col-xs-2 center-block">
       Статусы
        <a class="" href="<?php
        $params = array(
            'columnName' => 'status',
            'vector'=>$data['nextVector'],
            'page' =>$data['page']
        );
        Route::getUrl('task','index',$params);?>"
        >
            Пересортировать
        </a>
    </div>
    <div class="col-md-2  col-lg-2 col-sm-2 col-xs-2 center-block">

    </div>


</div>
<div class="row">
<?php foreach ($data['list'] as $task){ ?>

    <div class="col-md-2  col-lg-2 col-sm-2 col-xs-2 center-block task">
        <?php printf($task->getUserName());  ?>
    </div>
    <div class="col-md-2  col-lg-2 col-sm-3 col-xs-2 center-block task">
        <?php printf($task->getUserEmail());  ?>
    </div>
    <div class="col-md-4  col-lg-4 col-sm-4 col-xs-3 center-block task">
        <?php printf($task->getText());  ?>
    </div>
    <div class="col-md-2  col-lg-2 col-sm-2 col-xs-2 center-block task">
        <?php
        $status = $task->getStatus();
        $mod = $task->getEdited();
        $status ? printf('Выполнено <br>') : printf('Не Выполнено <br>');
        $mod ? printf('Было Oтредактировано'):printf('Не редактировалось');
        ?>
    </div>
    <div class="col-md-2  col-lg-2 col-sm-2 col-xs-2 center-block task">
        <a class="" href="<?php
        $params = array(
            'id' =>$task->getId()
        );
        Route::getUrl('task','editTask',$params);?>"
        >
            Редактировать
        </a>
    </div>

 <? } ?>
</div>
