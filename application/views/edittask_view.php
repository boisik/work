<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<div class="row">
    <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
        <fieldset>
            <legend>Редактировать задание</legend>

            <form method="POST" id="editTask" data-action="editTask?id=<?php printf($_GET['id']);  ?>">
                <label for="add_name"> Имя исполнителя</label><br/>
                <input disabled type="text" id="add_name" name="add_name" value="<?php printf($data->getUserName());  ?>"/>
                <label for="add_email">Адрес элекронной почты</label><br/>
                <input disabled type="text" id="add_email" name="add_email" value="  <?php printf($data->getUserEmail());  ?>"/>
                <label for="add_email">Введите текст задачи</label><br/>
                <textarea name="add_text" cols="20" rows="3">   <?php printf($data->getText());  ?> </textarea>
                <label for="add_status">Задача выполнена</label><br/>
                <?php $status = $data->getStatus();  ?>
                <input type="checkbox" name="add_status" id="add_status"  <?php if($status==1) echo("checked"); ?> />
                <br/>
                <input type="hidden" name="operation" value="edittask"/>
                <input type="submit"/>
            </form>

        </fieldset>
    </div>
    <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
        <div id="errors" class="errors">
        </div>

    </div>


