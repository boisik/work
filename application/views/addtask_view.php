<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<div class="row">
    <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
        <fieldset>
            <legend>Добавить задание</legend>

            <form method="POST" id="addtask" data-action="addtask/">
                <label for="add_name">Введите имя исполнителя</label><br/>
                <input type="text" id="add_name" name="add_name" value=""/>
                <label for="add_email">Введите адрес элекронной почты</label><br/>
                <input type="text" id="add_email" name="add_email" value=""/>
                <label for="add_email">Введите текст задачи</label><br/>
                <textarea name="add_text" cols="20" rows="3"></textarea>
                <input type="hidden" name="operation" value="addtask"/>
                <input type="submit"/>
            </form>

        </fieldset>
    </div>
    <div class="col-md-5 col-md-offset-5  col-lg-5 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
        <div id="errors" class="errors">
        </div>

    </div>


